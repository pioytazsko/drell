<?
require_once('_keybord_lang.php');
$searchword = switcher($_GET[searchword]);
//echo 'src='.$_GET[searchword].' res='.$searchword;
include('_search_engine.php');

//echo "--->".$sqlQuery;
?>
<td valign="top">
    <table id="Table2" width="100%"  border="0" cellpadding="0"  cellspacing="0"><tr height="1px" valign="top"><td  align="left" valign="top" style="padding-left:20px;padding-top:10px; padding-right:15px;">
                <table id="Table" width="100%"  border="0" cellpadding="0"  cellspacing="0">
                    <tr height="1px" valign="middle">
                        <td valign="top">
                            <?
                            echo show_path($_GET[id]) . " <a href='search.php'>Поиск</a>";
                            ?>
                        </td>
                    </tr>
                    <tr height="1px" valign="middle">
                        <td style="padding-top:5px;"><h1>Поиск по &laquo;<?= $_GET[searchword];?>&raquo;</h1></td>
                    </tr>
                    <tr height="1px" valign="middle">
                        <td style="padding-top:10px;padding-bottom:10px;">
                            <?
                            echo block("id='" . $_GET[id] . "'", "f3");
                            ?>
                        </td>
                    </tr>
                </table>
       <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr height="1px">
            <td width="100%" style="padding-top:10px;padding-bottom:30px;">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr height="1px"><td width="100%" style="background:#eaeaea;"></td></tr>
                </table>
                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px;">
                    <tr height="1px">
                        <td align="left" nowrap>
                        </td>
                        <!--
                        <td align="left" style="padding-right:7px;">Страницы:</td>
                        -->
                        <td align="right">
                            <?
                            $searchword = $_GET[searchword];
                            if ($searchword != "" && $searchword != "поиск...") {
                                $arr_searchwords = Array();
                                $separators = Array(" ", "\,", "\.", "\(", "\)", "\-");

                                function mysplit($sep) {
                                    global $arr_searchwords;
                                    $tmp_searchwords = Array();
                                    for ($i = 0; $i < count($arr_searchwords); $i++) {
                                        $res = split($sep, $arr_searchwords[$i]);
                                        //print_r($res);
                                        for ($j = 0; $j < count($res); $j++) {
                                            if (trim($res[$j]) != "")
                                                array_push($tmp_searchwords, trim($res[$j]));
                                        }
                                    }
                                    $arr_searchwords = $tmp_searchwords;
                                }

                                array_push($arr_searchwords, $searchword);
                                //print_r($arr_searchwords);

                                for ($i = 0; $i < count($separators); $i++) {
                                    mysplit($separators[$i]);
                                }

                                //print_r($arr_searchwords);

                                if (count($arr_searchwords) > 0) {
                                    $where = "";
                                    for ($i = 0; $i < count($arr_searchwords); $i++) {
                                        if ($i != 0)
                                            $where .= " OR ";
                                        $where .= " name REGEXP '[[:<:]]" . $arr_searchwords[$i] . "[[:>:]]' ";
                                    }
                                    echo showpaging($sqlQuery, "video_paging", "video_paging_selected", 20);
                                }
                            }
                            ?>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr height="1px">
            <td width="100%" valign="top">
<?
$searchword = $_GET[searchword];
if ($searchword == "" || $searchword == "поиск...")
    echo "Введите запрос для поиска";
else {
    if ($where != "")
        echo block($sqlQuery, "search_item", "", "", 20, "Поиск по запросу <b>\"" . $searchword . "\"</b> не дал результатов.");
}
?>
            </td>
        </tr>
        <tr height="30px">
            <td width="100%">
            </td>
        </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr height="1px">
            <td width="100%" style="padding-top:10px;padding-bottom:30px;">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr height="1px"><td width="100%" style="background:#eaeaea;"></td></tr>
                </table>
                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px;">
                    <tr height="1px">
                        <td align="right">
<?
if ($where != "")
    echo showpaging($sqlQuery, "video_paging", "video_paging_selected", 20);
?>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>         
                
                	
            </td>
            <td align="right" width="195px" style="padding-top:5px;">
                <?
                include("_new_cart.php");
                ?>

            </td>
        </tr>
    </table>
    

</td>

</tr>
</table>



</td>


</tr>
</table>




</td>
</tr>