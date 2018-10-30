<?php

namespace models;

class Filter
{
    private $db;
    private $name;
    private $tpl;

    public function __construct($tpl, $dbh)
    {
        $this->tpl = $tpl;
        $this->db = $dbh->db;
    }

    public function generateHtml()
    {
        $stmt = $this->db->prepare("SELECT `xfields` FROM nimpix_space_db2.dle_post WHERE xfields LIKE '%color%'");
        // $tpl = $this->tpl;
        $stmt->execute();
        $colors = [];
        $codes = [];
        $content = '';

        while ($row = $stmt->fetch()) {
            $xfields = xfieldsdataload($row['xfields']);
            $color_name = $xfields['color'];
            $color_code = $xfields['color_code'];
            if (in_array($xfields['color'], $colors)) {
                continue;
            } else {
                array_push($colors, $color_name);
                array_push($codes, $color_code);
                $content .= "<div class='color' data-color='" . $color_name . "' style='background:" . $color_code . "'></div>";
            }
        }
        $result = '<div class="color-block">' . $content . '</div>';

        echo $result;
//        $tpl->dir = TEMPLATE_DIR;
//        $tpl->load_template('filter.tpl');
//
//        $tpl->set('{filter}','1111111111');
//        $tpl->compile( 'content' );
    }


    public function Filter($request, $dbh)
    {
        if (empty($request)) {
            return false;
        }
        $stmt = $this->db->prepare('SELECT `id`, `title`, `category`, `alt_name`, `short_story`, `xfields` FROM nimpix_space_db2.dle_post WHERE xfields LIKE :name');

        $stmt->bindParam(':name', $this->name);
        $this->name = '%' . $request["color"] . '%';

        if ($stmt->execute()) {

            $render = '';

            while ($row = $stmt->fetch()) {

                $xfields = xfieldsdataload($row['xfields']);
                $post_image = self::post_image($row['short_story']);
                $post_image = str_replace('https', 'http', $post_image);
                $news_url = get_url(intval($row['category'])) . '/' . $row['id'] . '-' . $row['alt_name'] . '.html';

                $skidka = '<span class="discount">-' . $xfields["skidka"] . '%</span>';

                if (empty($xfields["skidka"])) {
                    $skidka = '';
                }

                $render .= '<div class="column-4">
                      <div class="cat-item">
                        <h3><a href="' . $news_url . '#akcii">' . $row["title"] . '</a></h3>
                        <div class="cat-img">
                          <a href="' . $news_url . '#akcii">
                            <!-- <img src="{image-1}" alt=""> -->
                            <img src="' . $post_image . '" alt="">
                            ' . $skidka . '
                          </a>
                        </div>
                        <div class="old_price">Старая цена: <span>' . $xfields["cena_m_old"] . '</span> руб.</div>
                        <div class="new_price">Новая цена: <span>' . $xfields["cena_m"] . '</span> руб.</div>
                      </div>
                      <div class="cat-btns clearfix">
                        <a href="' . $news_url . '#akcii" class="btn btn-more">Подробнее</a>
                        <input type="hidden" class="hidden-size" name="size" value="' . $xfields["razmer_m"] . ' см">
                        <input type="hidden" class="hidden-id" name="id" value="' . $row["id"] . '">
                        <a href="" class="btn btn-order" onclick="yaCounter27000663.reachGoal(\'order_form\'); return true;">Заказать</a>
                      </div>
                    </div>
                    ';
            }
        }

        $result = '<div class="row">' . $render . '</div>';

        return $result;
    }

    public function post_image($short_story)
    {

        $images = array();
        preg_match_all('/(img|src)=("|\')[^"\'>]+/i', $short_story, $media);
        $data = preg_replace('/(img|src)("|\'|="|=\')(.*)/i', "$3", $media[0]);

        foreach ($data as $url) {
            $info = pathinfo($url);
            if (isset($info['extension'])) {
                if ($info['filename'] == "spoiler-plus" OR $info['filename'] == "spoiler-plus") {
                    continue;
                }
                $info['extension'] = strtolower($info['extension']);
                if (($info['extension'] == 'jpg') || ($info['extension'] == 'jpeg') || ($info['extension'] == 'gif') || ($info['extension'] == 'png')) {
                    array_push($images, $url);
                }
            }
        }
        return $images[0];
    }
}


