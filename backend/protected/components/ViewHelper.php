<?php 
class ViewHelper
{
    // russian date
    public function russian_date($ru_date){
        $date=explode(".", date("d.m.Y", $ru_date));
        switch ($date[1]){
            case 1: $date[1]='января'; break;
            case 2: $date[1]='февраля'; break;
            case 3: $date[1]='марта'; break;
            case 4: $date[1]='апреля'; break;
            case 5: $date[1]='мая'; break;
            case 6: $date[1]='июня'; break;
            case 7: $date[1]='июля'; break;
            case 8: $date[1]='августа'; break;
            case 9: $date[1]='сентября'; break;
            case 10: $date[1]='октября'; break;
            case 11: $date[1]='ноября'; break;
            case 12: $date[1]='декабря'; break;
        }
        
        $allDate = $date[0] . ' ' . $date[1] . ' ' . $date[2];
        
        
        return array(
            'rday'=>$date[0],
            'rmonth'=>$date[1],
            'ryear'=>$date[2],
            'allDate'=>$allDate,
        );
        
    } 
    
    // bbcode parser
  public function replaceBBCode($text_post) {
    $str_search = array(
      "#\\\n#is",
      "#\[table\](.+?)\[\/table\]#is",
      "#\[tr\](.+?)\[\/tr\]#is",
      "#\[td\](.+?)\[\/td\]#is",
      "#\[b\](.+?)\[\/b\]#is",
      "#\[i\](.+?)\[\/i\]#is",
      "#\[u\](.+?)\[\/u\]#is",
      "#\[code\](.+?)\[\/code\]#is",
      "#\[quote\](.+?)\[\/quote\]#is",
      "#\[url=(.+?)\](.+?)\[\/url\]#is",
      "#\[url\](.+?)\[\/url\]#is",
      "#\[img\](.+?)\[\/img\]#is",
      "#\[size=(.+?)\](.+?)\[\/size\]#is",
      "#\[color=(.+?)\](.+?)\[\/color\]#is",
      "#\[list\](.+?)\[\/list\]#is",
      "#\[list=(1|a|I)\](.+?)\[\/list\]#is", 
      "#\[\*\](.+?)\[\/\*\]#"
    );
    $str_replace = array(
      "<br />",
      "<table>\\1</table>",
      "<tr>\\1</tr>",
      "<td>\\1</td>",
      "<b>\\1</b>",
      "<i>\\1</i>",
      "<span style='text-decoration:underline'>\\1</span>",
      "<code class='code'>\\1</code>",
      "<table width = '95%'><tr><td>Цитата</td></tr><tr><td class='quote'>\\1</td></tr></table>",
      "<a href='\\1'>\\2</a>",
      "<a href='\\1'>\\1</a>",
      "<img src='\\1' alt = 'Изображение' />",
      "<span style='font-size:\\1%'>\\2</span>",
      "<span style='color:\\1'>\\2</span>",
      "<ul>\\1</ul>",
      "<ol type='\\1'>\\2</ol>", 
      "<li>\\1</li>"
    );
    return preg_replace($str_search, $str_replace, $text_post);
  }
}