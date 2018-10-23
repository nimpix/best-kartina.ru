<?php

/*
=============================================================================
 ����: tagface.php (frontend) ������ 1.0
-----------------------------------------------------------------------------
 �����: ����� ��������� ����������, mail@mithrandir.ru
-----------------------------------------------------------------------------
 ����������: ����� SEO ������� ��� �����
=============================================================================
*/

    // ���������
    if( !defined( 'DATALIFEENGINE' )) {
            die( "Hacking attempt!" );
    }

    /*
     * ����� ������ SEO ������� ��� �����
     */
    class TagFace
    {
        /*
         * ����������� ������ TagFace - ����� �������� �������� dle_api
         * @param $dle_api - ������ ������ DLE_API
         */
        public function __construct()
        {
            // ���������� DLE_API
            global $db, $config;
            include ('engine/api/api.class.php');
            $this->dle_api = $dle_api;
        }


        /*
         * ������� ����� ������ TagFace
         */
        public function run()
        {
            // ������������ ���������� ����������
            global $dle_module, $db;

            // �������� �� �������� ���������� � ����
            if(($dle_module == 'tags'))
            {             
                // �������� ����� �������� � ��� �� �������
                $page = intval($_REQUEST['cstart']);
                $tag_id = urldecode ($_REQUEST['tag']);
                // �������� ��������� �� �������� �� ������ DLE
                //if($this->dle_api->dle_config['charset'] == "windows-1251" AND $this->dle_api->dle_config['charset'] != detect_encoding($tag_id) )
                //{
                //    $tag_id = iconv( "UTF-8", "windows-1251//IGNORE", $tag_id );
                //}
                $tag_id = @$db->safesql( htmlspecialchars ( strip_tags ( stripslashes ( trim ( $tag_id ) ) ), ENT_QUOTES ) );

                // ������� ���������� ���������� ������ �� ����
                $output = false;
                if($this->dle_api->dle_config['allow_cache'] == 'yes')
                {
                    $output = $this->dle_api->load_from_cache('tagface_'.md5($tag_id.'_'.$page));
                }

                // ���� �������� ���� ��� ������ ������������ ��������, ������� ���������� ����
                if($output !== false)
                {
                    $this->showOutput($output);
                    return;
                }
                
                // ���� ��������������� ������ � ������� tag_face
                $tagFace = $this->dle_api->load_table (PREFIX."_tag_face", '*', 'tag_id = "'.$tag_id.'"', false);

                // ��������� ����� ������ � ��� ������, ���� ������ ������� � ������ ����������� �� ������� ��������
                if(!empty($tagFace) && $tagFace['module_placement'] != 'nowhere' && ($tagFace['module_placement'] == 'all_pages' || $page < 2))
                {
                    // ����� ���������
                    if($tagFace['name_placement'] == 'all_pages' || $page < 2)
                    {
                        switch($tagFace['show_name'])
                        {
                            case 'show':
                                if($tagFace['name'] != '')
                                {
                                    $name = stripslashes($tagFace['name']);
                                }
                                break;
                            case 'default':
                                if($tag_id != '')
                                {
                                    $name = stripslashes($tag_id);
                                }
                                break;
                            case 'hide':
                                break;
                        }
                    }
                    
                    // ���� ������ �������������� ��������� ��� ��������� �������, � �������� ������������ ������ �� ������
                    elseif($page >= 2 && $tagFace['name_pages'] != '')
                    {
                        $name = stripslashes($tagFace['name_pages']);
                    }

                    // ����� ��������
                    if($tagFace['description_placement'] == 'all_pages' || $page < 2)
                    {
                        switch($tagFace['show_description'])
                        {
                            case 'show':
                                if($tagFace['description'] != '')
                                {
                                    $description = stripslashes($tagFace['description']);
                                }
                                break;
                            case 'hide':
                                break;
                        }
                    }
                    
                    // ���� ������� �������������� �������� ��� ��������� �������, � �������� ������������ ������ �� ������
                    elseif($page >= 2 && $tagFace['description_pages'] != '')
                    {
                        $description = stripslashes($tagFace['description_pages']);
                    }
                }
                
                // ���� ������ �� ����������� �� ������ �������� ��� ������ �� �������, �� ����� ������ ����������
                else
                {
                    return false;
                }
            }
            
            $output = $this->applyTemplate('tagface',
                array(
                    '{name}'          => $name,
                    '{description}'   => $description,
                ),
                array(
                    "'\[show_name\\](.*?)\[/show_name\]'si" => !empty($name)?"\\1":'',
                    "'\[show_description\\](.*?)\[/show_description\]'si" => !empty($description)?"\\1":'',
                )
            );
            
            // ���� ��������� �����������, ��������� � ��� �� ������� ����
            if($this->dle_api->dle_config['allow_cache'] == 'yes')
            {
                $this->dle_api->save_to_cache('tagface_'.md5($tag_id.'_'.$page), $output);
            }

            $this->showOutput($output);
        }


        /*
         * ����� ������������ tpl-������, �������� � �� ���� � ������� � �������
         * @param $output - ��������������� ���������
         */
        public function showOutput($output)
        {
            echo $output;
        }
        
        
        

        /*
         * ����� ������������ tpl-������, �������� � �� ���� � ���������� ����������������� ������
         * @param $template - �������� �������, ������� ����� ���������
         * @param $vars - ������������� ������ � ������� ��� ������ ���������� � �������
         * @param $vars - ������������� ������ � ������� ��� ������ ������ � �������
         *
         * @return string tpl-������, ����������� ������� �� ������� $data
         */
        public function applyTemplate($template, $vars = array(), $blocks = array())
        {
            // ���������� ���� ������� $template.tpl, ��������� ���
            $tpl = new dle_template();
            $tpl->dir = TEMPLATE_DIR;
            $tpl->load_template($template.'.tpl');

            // ��������� ������ �����������
            foreach($vars as $var => $value)
            {
                $tpl->set($var, $value);
            }

            // ��������� ������ �������
            foreach($blocks as $block => $value)
            {
                $tpl->set_block($block, $value);
            }

            // ����������� ������ (��� �� ��� �� �������� ;))
            $tpl->compile($template);

            // ������� ���������
            return $tpl->result[$template];
        }
    }
    /*---End Of TagFace Class---*/

    // ������ ������ ������ TagFace
    $tagFace = new TagFace;

    // ��������� ������� ����� ������
    $tagFace->run();
    
?>