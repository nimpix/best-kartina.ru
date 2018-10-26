<?php

namespace models;

class Filter
{
    private $db;
    private $name;

    public function Filter($request, $dbh, $tpl)
    {
        $this->db = $dbh->db;

        $stmt = $this->db->prepare('SELECT `id`, `title`, `category`, `alt_name`, `short_story`, `xfields` FROM nimpix_space_db2.dle_post WHERE xfields LIKE :name');

        $stmt->bindParam(':name', $this->name);
        $this->name = '%зеленый%';

        if ($stmt->execute()) {

            while ($row = $stmt->fetch()) {

                $xfields = xfieldsdataload( $row['xfields']);
                $post_image = self::post_image($row['short_story']);

                $news_url = get_url( intval( $row['category'] ) ) . '/' .$row['id'].'-'.$row['alt_name'].'.html';

                echo '<div class="column-4">
                      <div class="cat-item">
                        <h3><a href="'.$news_url.'#akcii">'.$row["title"].'</a></h3>
                        <div class="cat-img">
                          <a href="'.$news_url.'#akcii">
                            <!-- <img src="{image-1}" alt=""> -->
                            <img src="'.$post_image.'" alt="">
                            <span class="discount">-'.$xfields["skidka"].'%</span>
                          </a>
                        </div>
                        <div class="old_price">Старая цена: <span>'.$xfields["cena_m_old"].'</span> руб.</div>
                        <div class="new_price">Новая цена: <span>'.$xfields["cena_m"].'</span> руб.</div>
                      </div>
                      <div class="cat-btns clearfix">
                        <a href="'.$news_url.'#akcii" class="btn btn-more">Подробнее</a>
                        <input type="hidden" class="hidden-size" name="size" value="'.$xfields["razmer_m"].' см">
                        <input type="hidden" class="hidden-id" name="id" value="'.$row["id"].'">
                        <a href="" class="btn btn-order" onclick="yaCounter27000663.reachGoal(\'order_form\'); return true;">Заказать</a>
                      </div>
                    </div>
                    ';
            }
        }
    }

    public function post_image($short_story){

        $images = array();
        preg_match_all('/(img|src)=("|\')[^"\'>]+/i', $short_story, $media);
        $data=preg_replace('/(img|src)("|\'|="|=\')(.*)/i',"$3",$media[0]);

        foreach($data as $url) {
            $info = pathinfo($url);
            if (isset($info['extension'])) {
                if ($info['filename'] == "spoiler-plus" OR $info['filename'] == "spoiler-plus" ) continue;
                $info['extension'] = strtolower($info['extension']);
                if (($info['extension'] == 'jpg') || ($info['extension'] == 'jpeg') || ($info['extension'] == 'gif') || ($info['extension'] == 'png')) array_push($images, $url);
            }
        }
        return $images[0];
    }
}

