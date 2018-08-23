<?php
/**
 * SmartDevTable For Laravel
 * Porting from class NewTable (created by Zona Ariemenda <zona@edi-indonesia.co.id>)
 * Modified : syafrizal (syafrizal@edi-indonesia.co.id)
 */

namespace rndediiv2\SmartDevTable;
use Illuminate\Http\Request;
use DB;
error_reporting(E_ERROR);

class SmartDevTable
{
    protected $rows                 = [];
    protected $columns              = [];
    protected $hiderows             = array();
    protected $keys                 = [];
    protected $proses               = [];
    protected $keycari              = [];
    protected $heading              = [];
    protected $width                = [];
    protected $menuWidth            = "";
    protected $autoHeading          = TRUE;
    protected $showChk              = TRUE;
    protected $useWhere             = FALSE;
    protected $caption              = NULL;
    protected $template             = NULL;
    protected $newLine              = "";
    protected $language             = "ID";
    protected $emptyCell            = "&nbsp;";
    protected $action               = "";
    protected $details              = "";
    protected $baris                = "10";
    protected $hal                  = "AUTO";
    protected $showSearch           = TRUE;
    protected $single               = TRUE;
    protected $dropdown             = TRUE;
    protected $orderBy              = 1;
    protected $groupBy              = [];
    protected $sortBy               = "ASC";
    protected $postMethod           = FALSE;
    protected $tbTarget             = "";
    protected $title                = "";
    protected $expandRow            = FALSE;
    protected $addFilter            = FALSE;
    protected $fieldFilters         = "";
    protected $dbComboBox           = [];
    protected $setTrId              = FALSE;
    protected $attrId               = "";
    protected $callBack             = "";
    protected $filedCallBack        = "";
    protected $divAppend            = FALSE;
    protected $iconCustoms          = [];

    
    public function __constructor()
    {

    }

    public function width($row) 
    {
        $this->width = $row;
        return;
    }

    public function menuWidth($row)
    {
        $this->menuWidth = $row;
        return;
    }

    public function showSearch($showSearch)
    {
        $this->showSearch = $showSearch;
        return;
    }

    public function showChk($showChk)
    {
        $this->showChk = $showChk;
        return;
    }

    public function useWhere($useWhere)
    {
        $this->useWhere = $userWhere;
        return;
    }

    public function columns($col)
    {
        $this->columns = $col;
        return;
    }

    public function groupBy($fields)
    {
        if(!is_array($fields))
        {
            return FALSE;
        }
        $this->groupBy = $fields;
        return;
    }

    public function orderBy($orderBy)
    {
        $this->orderBy = $orderBy;
        return;
    }

    public function sortBy($sortBy)
    {
        $this->sortBy = $sortBy;
        return;
    }

    public function rowCount($row)
    {
        $this->baris = $row;
        return;
    }

    public function action($action)
    {
        $this->action = $action;
        return;
    }

    public function detail($uri)
    {
        $this->details = $uri;
        return;
    }

    public function tbTarget($target)
    {
        $this->tbTarget = $target;
        return;
    }

    public function expandRow($expand)
    {
        $this->expandRow = $expand;
        return;
    }

    public function hiddens($row)
    {
        if(!is_array($row))
        {
            $row = array($row);
        }
        foreach($row as $a)
        {
            if(!in_array($a, $this->hiderows)) $this->hiderows[] = $a;
        }
        return;
    }

    public function keys($row)
    {
        if(!is_array($row))
        {
            $row = array($row);
        }
        foreach($row as $a)
        {
            if(!in_array($a, $this->keys)) $this->keys[] = $a;
        }
        return;
    }

    public function menu($row)
    {
        if(!is_array($row))
        {
            return FALSE;
        }
        $this->proses = $row;
        return;
    }

    public function search($row)
    {
        if(!is_array($row))
        {
            return FALSE;
        }
        $this->keycari = $row;
        return;
    }

    public function single($more)
    {
        $this->single = $more;
        return;
    }

    public function dropdown($btn)
    {
        $this->dropdown = $btn;
        return;
    }

    public function postMethod($postMethod)
    {
        $this->postMethod = $postMethod;
        return;
    }

    public function addFilter($clause)
    {
        $this->addFilter = $clause;
        return;
    }

    public function fieldFilter($fields)
    {
        $this->fieldFilters = $fields;
        return;
    }

    public function setTrId($attrId)
    {
        $this->setTrId = $attrId;
        return;
    }

    public function attrId($attr)
    {
        $this->attrId = $attr;
        return;
    }

    public function callBack($callback)
    {
        $this->callBack = $callback;
        return;
    }

    public function fieldCallBack($fields)
    {
        $this->filedCallBack = $fields;
        return;
    }

    public function divAppend($div)
    {
        $this->divAppend = $div;
        return;
    }

    public function title($title)
    {
        $this->title = $title;
        return;
    }

    public function iconCustoms($iconCustoms)
    {
        if(is_array($iconCustoms))
        {
            foreach($iconCustoms as $val => $key)
            {
                $this->iconCustoms[$val] = $key;
            }
        }
        return $this->iconCustoms;
    }

    public function setTemplate($template)
    {
        if(!is_array($template)) return FALSE;
        $this->template = $template;
    }

    public function setHeadings()
    {
        $args = func_get_args();
        $this->heading = (is_array($args[0])) ? $args[0] : $args;
    }

    public function makeColumns($array = array(), $colLimit = 0)
    {
        if(!is_array($array) OR count($array) == 0 ) return FALSE;
        $this->autoHeading = FALSE;
        if($colLimit == 0) return $array;
        $new = $array();
        while(count($array) > 0)
        {
            $temp = array_splice($array, 0, $colLimit);
            if(count($temp) < $colLimit)
            {
                for($i = count($temp); $i < $colLimit; $i++)
                {
                    $temp[] = '$nbsp;';
                }
            }
            $new = $temp;
        }
        return $new;
    }

    public function setEmpty($val)
    {
        $this->emptyCell = $val;
    }

    public function addRow()
    {
        $args = func_get_args();
        $this->rows[] = (is_array($args[0])) ? $args[0] : $args;
    }

    public function setCaption($caption)
    {
        $this->caption = $caption;
        return;
    }

    public function generate($tableData = NULL, Request $request)
    {
        if(!is_null($tableData))
        {
            if(is_object($tableData))
            {
                $this->setFromObject($tableData);
            }
            else if(is_array($tableData))
            {
                $setHeading = (count($this->heading) == 0 AND $this->autoHeading == FALSE) ? FALSE : TRUE;
                $this->setFromArray($tableData, $setHeading);
            }
            else if($tableData != "")
            {
                if(env('DB_CONNECTION') == 'sqlsrv' || env('DB_CONNECTION') == 'oracle' && !is_array($this->columns)) return 'Missing require params (columns)';
                if($request->input('data-post')) $this->clear();

                $kunci = "";
                $terkunci = "";
                $tercari = "";

                if(!$request->input('post-data')) {
                    if($this->addFilter)
                    {
                        $default = strpos(strtolower($tableDate), "where");
                        if($default === FALSE)
                            $tableData .= " WHERE " . $this->fieldFilters;
                        else
                            $tableData .= " AND " . $this->fieldFilters;
                    }
                }
                else
                {
                    $this->addFilter = FALSE;
                    $this->fieldFilters = "";
                }
                if(!$request->input('inline'))
                {
                    #For single search with select box as key search
                    $arrkunci = explode("|", $request->input('opt_search'));
                    if($request->input('range') && $request->input('block'))
                    {
                        #Range Date picker with single searching
                        if(is_array($request->input('range')))
                        {
                            $arrbetween = $request->input('range');
                            $range = "BETWEEN '" . $arrbetween[0] . "' AND '" . $arrbetween[1] . "'";
                            $arrcari = explode("|", $range);
                        }
                    }
                    else
                    {
                        $arrcari = explode("|", $request->input('key_search'));
                    }
                }
                else
                {
                    $arrkunci = array_keys($request->input('opt_search'));
                    $arrcari = $request->input('opt_search');
                }

                $and = "";

                foreach($arrkunci as $z => $kunci)
                {
                    if(array_key_exists($kunci, $this->keycari))
                    {
                        $terkunci = $this->keycari[$kunci];
                        $terkunci = $terkunci[0];
                        $cari = $arrcari[$z];
                        if(is_array($cari))
                        {
                            if($cari[0] != "" && $cari != "")
                            {
                                if(count(array_unique($cari)) > 1)
                                {
                                    $tercari .= " $and $terkunci BETWEEN '" . $cari[0] . "' AND '" . $cari[1] . "'";
                                    $and = " AND ";
                                }
                            }
                        }
                        else
                        {
                            if($cari != "")
                            {
                                $cari = str_replace("'","''", $cari);
                                if(substr($terkunci, 0, 4) == "{IN}")
                                {
                                    $terkunci = substr($terkunci, 4);
                                    $tercari .= " $and " . str_replace("{LIKE}", "LIKE '%$cari%'", $terkunci);
                                }
                                else
                                {
                                    $between = strpos(strtolower($cari), "between");
                                    if($between === FALSE)
                                        $tercari .= " $and $terkunci LIKE '%$cari%'";
                                    else
                                        $tercari .= " $terkunci " . str_replace("''", "'", $cari);
                                }
                                $and = " AND ";
                            }
                        }
                    }
                }

                if($this->baris != "ALL")
                {
                    if($request->input('tb_view') < 1) 
                        $this->baris = 10;
                    else 
                        $this->baris = $request->input('tb_view');
                }

                if($tercari != "")
                {
                    if($this->useWhere)
                    {
                        $tableData .= " WHERE $tercari";
                    }
                    else
                    {
                        $exists = strpos(strtolower($tableData), "where");
                        if($exists === FALSE)
                            $tableData .= " WHERE $tercari";
                        else 
                            $tableData .= " AND $tercari";
                    }
                }
                #Group By
                if(count($this->groupBy) > 0)
                {
                    $sKomaGroup = "";
                    $sColumnsGroup = "";
                    foreach($this->groupBy as $z)
                    {
                        $sColumnsGroup .= $sKomaGroup;
                        $sKomaGroup = ",";
                    }
                    $tableData = $tableData . " GROUP BY " . $sColumnsGroup;
                }
                #Num rows of records
                $iTotalRecord = 0;
                $iTotalCount = 0;
                if(env('DB_CONNECTION') == 'oracle')
                    $objTableCount = DB::select("SELECT COUNT(1) AS jml FROM ($tableData)");
                else
                    $objTableCount = DB::select("SELECT COUNT(1) AS jml FROM ($tableData) AS TBL");

                if(sizeof($objTableCount) > 0)
                {
                    foreach($objTableCount as $a)
                    {
                        $iTotalCount = $a->jml;
                    }
                    $iTotalRecord = $iTotalCount;
                }
                else
                {
                    $iTotalRecord = 0;
                }
                #Sort By
                if($request->input('orderby'))
                {
                    $this->orderBy = (is_numeric($request->input('orderby')) ? (int)$request->input('orderby') : $request->input('orderby'));
                    $this->sortBy = $request->input('sortby');
                    if(env('DB_CONNECTION') == 'sqlsrv')
                    {
                        if(is_numeric($this->orderBy))
                        {
                            $orderby = $this->columns[$this->orderBy-1];
                            if(is_array($orderby)) $orderby = $orderby[0];
                        }
                        else
                        {
                            $orderby = $request->input('orderby');
                        }
                    }
                    else
                    {
                        $orderby = $this->orderBy;
                    }
                }
                else
                {
                    if(is_numeric($this->orderBy))
                    {
                        if(env('DB_CONNECTION') == 'sqlsrv')
                        {
                            $orderby = $this->columns[$this->orderBy-1];
                            if(is_array($orderby)) $orderby = $orderby[0];
                        }
                        else
                        {
                            $orderby = $this->orderBy;
                        }
                    }
                    else
                    {
                        $orderby = $this->orderBy;
                    }
                }
                #Rows ALL || AUTO
                if($this->baris != "ALL")
                {
                    $iTotalCount = ceil($iTotalCount / $this->baris);
                    if($this->hal == "AUTO") $this->hal = $request->input('tb_hal');
                    if($this->hal < 1) $this->hal = 1;
                    if($this->hal > $iTotalCount) $this->hal = $iTotalCount;
                    if($this->hal == 1)
                    {
                        if(env('DB_CONNECTION') == 'sqlsrv')
                        {
                            $iFrom = $this->hal;
                            $iTo = $this->baris;
                        }
                        else if(env('DB_CONNECTION') == 'oracle')
                        {
                            $iFrom = 0;
                            $iTo = $this->baris * $this->hal;
                        }
                        else
                        {
                            $iFrom = 0;
                            $iTo = $this->baris;
                        }
                    }
                    else
                    {
                        if(env('DB_CONNECTION') == 'sqlsrv')
                        {
                            $iFrom = ($this->hal * $this->baris) - $this->baris + 1;
                            $iTo = $this->hal * $this->baris;
                        }
                        else if(env('DB_CONNECTION') == 'oracle')
                        {
                            $iFrom = $this->hal > 0 ? ($this->hal-1) * $this->baris : 0;
                            $iTo = $this->baris * $this->hal;
                        }
                        else
                        {
                            $iFrom = $this->hal > 0 ? ($this->hal-1) * $this->baris : 0;
                            $iTo = $this->baris;
                        }
                    }

                    if(env('DB_CONNECTION') == 'sqlsrv')
                    {
                        $tableData = "SELECT * FROM (SELECT ROW_NUMBER() OVER (ORDER BY $orderby $this->sortBy) AS HAL, ".substr($tableData, 6)." ) AS TBLTMP WHERE HAL >= $iFrom AND HAL <= $iTo";
                    }
                    else if(env('DB_CONNECTION') == 'oracle')
                    {
                        $tableData = "SELECT * FROM ( SELECT ROWNUM AS RNUM, a.* FROM ($tableData ORDER BY $orderby $this->sortBy) a WHERE ROWNUM <= $iTo ) WHERE RNUM >= $iFrom";
                    }
                    else if(env('DB_CONNECTION') == 'mysql')
                    {
                        $tableData = "$tableData ORDER BY $orderby $this->sortBy LIMIT $iFrom, $iTo";
                    }

                }
                else
                {
                    $tableData = $tableData . " ORDER BY $orderby $this->sortBy";
                }
                $tableData = DB::select(trim(preg_replace('/\s+/',' ', $tableData)));
                $this->setFromObject($tableData);
            }
        }
        #End Table Data is not null
        if (count($this->heading) == 0 AND count($this->rows) == 0)
		{
			return '<i>Undefined Table Data</i>';
        }
        
        #Compile template
        $this->compileTemplate();
        
        #Start print table component
        $out  = '<div class="section" style="width: 98%; margin: 0px auto;">';
        $out .= '<div class="smartDev-overlay"><div class="smartDev-overlay-content"></div></div>';
        $out .= '   <form id="'. $this->tbTarget.'" action="'. $this->action.'" autocomplete="off">';

        #Condition for type searching, single keyword or multiple keywords searching
        if($this->single)
        $out .= '   <input type="hidden" id="searchtipe" value="1" '. ($this->postMethod ? 'name="block"' : '') . '>';
        else
        $out .= '   <input type="hidden" id="searchtipe" value="N" '. ($this->postMethod ? 'name="inline"' : '') . '>';
        $out .= '   <input type="hidden" name="_token" value="'. csrf_token() .'">';
        $arrSubHome = array();
        if(count($this->proses) > 0)
        {
            foreach($this->proses as $proA => $proB)
            {
                if(count($proB) > 3) {
                    if($proB[3] == 'home' && $proB[0] == 'GET' && $proB[2] == '0') $arrSubHome[$proA] = $proB;
                }
            }
        }


        /**
         * Containers Row
         * Split colSmartDev-3 for searching panel on left side
         * colSmartDev-9 grid panel on right side
         */

        if(!$request->input('data-post'))
        {
            $out .= '<div class="content-box-SmartDev">';
            $out .=     '<div class="rowSmartDev">';
        }

        /**
         * Left side
         * And enable search
         */
        if(!$request->input('data-post'))
        {
            if($this->showSearch)
            {
                $counter = 3;
                $out .=         '<div class="colSmartDev-lg-3 colSmartDev-md-3 colSmartDev-sm-3 colSmartDev-xs-3">';
                $out .=             '<div class="element-wrapper-SmartDev">';
                $out .=                 '<div class="element-box-SmartDev">';
                $out .=                     '<h6 class="element-header-SmartDev">Filter</h6>';

                foreach($this->keycari as $a => $b){
                    $class = ($a <= 1 ? "defaultshow" : "defaulthide");
                    if (count($b)>2)
                    {
                        if ($b[2][0]=="ARRAY")
                        {
                            $out .=             '<div class="form-group '.$class.'">';
                            $out .=                 '<label id="lbl_'.str_replace(".", "_", $b[0]).'">'.$b[1].'</label>';
                            $out .=                 '<select class="form-control keywords" name="opt_search['.$a.']" id="'.rand(pow(10, $counter-1), pow(10, $counter)-1).'" '.((is_array($b[3]) && $this->postmethod) ? 'data-url = "'.$b[3][0].'"' : "").'>';
                            $out .=                     '<option value=""></option>';
                            foreach ($b[2][1] as $valopt => $selopt) {
                                $out .=                 '<option value= "'.$valopt.'">'.$selopt.'</option>';
                            }
                            $out .=                 '</select>';
                            $out .=             '</div>';
                        }
                        else if ($b[2][0] == "DATEPICKER")
                        {
                            $out .=             '<div class="form-group '.$class.'">';
                            $out .=                 '<label id="lbl_'.str_replace(".", "_", $b[0]).'">'.$b[1].'</label>';
                            $out .=                 '<input type="text" class="form-control date-pickers keywords" data-date-format="'.$b[2][1][2].'" placeholder="'.$b[2][1][2].'" name="opt_search['.$a.']"" id="'.rand(pow(10, $counter-1), pow(10, $counter)-1).'">';
                            $out .=             '</div>';
                        }
                        else if($b[2][0] == "DATERANGE")
                        {
                            $out .=             '<div class="rowSmartDev '.$class.'">';
                            $out .=                 '<div class="colSmartDev-lg-6 colSmartDev-md-6 colSmartDev-sm-6 colSmartDev-xs-6">';
                            $out .=                     '<div class="form-group">';
                            $out .=                         '<label id="lbl_start_pick">Dari</label>';
                            $out .=                         '<div class="date-input">'; //add date-input custom to SmartDevTable.css
                            $out .=                             '<input class="form-control datepickers-range keywords date-start" type="text" placeholder="Dari" name="opt_search['.$a.'][]" data-date-format="'.$b[2][1][2].'" id="'.rand(pow(10, $counter-1), pow(10, $counter)-1).'">';
                            $out .=                         '</div>';
                            $out .=                     '</div>';
                            $out .=                 '</div>';
                            $out .=                 '<div class="colSmartDev-lg-6 colSmartDev-md-6 colSmartDev-sm-6 colSmartDev-xs-6">';
                            $out .=                     '<div class="form-group">';
                            $out .=                         '<label id="lbl_start_pick">Sampai</label>';
                            $out .=                         '<div class="date-input">'; //add date-input custom to SmartDevTable.css
                            $out .=                             '<input class="form-control datepickers-range keywords date-start" type="text" placeholder="Dari" name="opt_search['.$a.'][]" data-date-format="'.$b[2][1][2].'" id="'.rand(pow(10, $counter-1), pow(10, $counter)-1).'">';
                            $out .=                         '</div>';
                            $out .=                     '</div>';
                            $out .=                 '</div>';
                            $out .=             '</div>';
                        }
                    }
                    else
                    {
                        $out .=                 '<div class="form-group '. $class .'">';
                        $out .=                     '<label id="lbl_'.str_replace(".", "_", $b[0]).'">'.$b[1].'</label>';
                        $out .=                     '<input type="text" class="form-control keywords" id="'.$b[0].'" name="opt_search['.$a.']" id="'.rand(pow(10, $counter-1), pow(10, $counter)-1).'">';
                        $out .=                 '</div>';
                    }

                }

                if(count($this->keycari) > 2){
                    $out .=                     '<div class="form-group">';
                    $out .=                         '<div class="rowSmartDev">';
                    $out .=                             '<div class="colSmartDev-lg-9 colSmartDev-md-9 colSmartDev-sm-9 colSmartDev-xs-9">';
                    $out .=                                 '<label>Tampilkan opsi lainnya</label>';
                    $out .=                             '</div>';
                    $out .=                             '<div class="colSmartDev-lg-3 colSmartDev-md-3 colSmartDev-sm-3 colSmartDev-xs-3">';
                    $out .=						            '<label class="switchSmartDev"><input type="checkbox" class="chk-advanced" id="chk-advanced-'.$this->tbTarget.'"><span class="sliderSmartDev round"></span></label>';
                    $out .=                             '</div>';
                    $out .=                         '</div>';
					$out .=                     '</div>';
                }

                $out .=                 '<div class="form-group">';
                $out .=                     '<button class="mr-2 mb-2 btn btn-primary btn-md" data-form = "#'.$this->tbTarget.'" data-action = "'.$this->action.'" data-target =".'.$this->tbTarget.'" data-post = "TRUE" style="cursor:pointer;" data-screen-loader="#screen_'.$this->tbTarget.'" id="btn-search-'.rand().'" onclick="postobj($(this)); return false;">Terapkan</button>';
                $out .=                 '</div>';

                $out .=                 '</div>';
                $out .=             '</div>';
                $out .=         '</div>';
            }
        }
        /**
         * End left side
         */

        /**
         * Right side
         */
        if(!$request->input('data-post'))
        {
            if($this->showSearch)
            {
                $out .= '<div class="colSmartDev-lg-9 colSmartDev-md-9 colSmartDev-sm-9 colSmartDev-xs-9 ' . $this->tbTarget . '">';
            }
            else
            {
                $out .= '<div class="colSmartDev-lg-12 colSmartDev-md-12 colSmartDev-sm-12 colSmartDev-xs-12 ' . $this->tbTarget . '">';
            }
        }

        /**
         * Starting screen loader
         */
        $out .= '<div class="container-screen-big-loader" data-spinner-target="'. $this->tbTarget.'" id="screen_'.$this->tbTarget.'">
                    <div class="animated-background">
                        <div class="background-masker header-top-title-first"></div>
                        <div class="background-masker subheader-title-left"></div>
                        <div class="background-masker subheader-title-right"></div>
                        <div class="background-masker subheader-separator"></div>
                        <div class="background-masker section-group-title-left"></div>
                        <div class="background-masker section-group-title-right"></div>
                        <div class="background-masker section-group-title-separator"></div>
                        <div class="background-masker section-group-row-left"></div>
                        <div class="background-masker section-group-row-right"></div>
                        <div class="background-masker section-group-row-separator"></div>
                        <div class="background-masker section-group-pagination-left"></div>
                        <div class="background-masker section-group-pagination-nav"></div>
                        <div class="background-masker section-group-pagination-right"></div>
                        <div class="background-masker section-end-bottom"></div>
                    </div>
                </div>';
        /**
         * End screen loader
         */

        $out .=         '<div class="element-wrapper-SmartDev '.$this->tbTarget. '" style="display: none;">';
        $out .=             '<div class="element-box-SmartDev">';
        $out .=                 '<h6 class="element-header-SmartDev">' . $this->title . '</h6>';



        if (count($this->proses) > 0 && $this->showChk){
            if(count($arrSubHome)>0){
                $out .=     '<span class="button-new-fixed">';
                foreach ($arrSubHome as $a => $b){
                    $out .= '<a href="javascript:void(0);" onclick="submenuHome($(this)); return false;" id = "'.rand().'new" act="'.$b[1].'" value="'.$a.'" '.($b[5]=="append" ? "data-append=\"true\" data-div=\"#newdiv\" data-class = \".formsearch"   : "").' '.($b[5]=="modal" ? "data-modal=\"true" : "").'"><i class="'. $b[4].'"></i></a>';

                }
                $out .= '</span>';
            }
        }



        $out .=                     $this->template['table_open'];
        $out .=                     '<thead>';

        if(count($this->heading) > 0)
        {
            if(env('DB_CONNECTION') == 'oracle')
                $this->hiderows[] = 'rnum';
            else
                $this->hiderows[] = 'HAL';

            if ($this->baris=='ALL') $out .= '<tr class="head">';
            else $out .= '<tr>';
            foreach($this->heading as $z => $heading)
            {
                if(env('DB_CONNECTION') =='sqlsrv')
                {
                    if(!$this->showChk) $z--;
                }
                else
                {
                    if(!$this->showChk) $z++;

                }
                if(!in_array($heading, $this->hiderows))
                {
                    if (((env('DB_CONNECTION') == 'sqlsrv') && $z < 0 && $this->show_chk) || ($z == 0 && $this->show_chk))
                    {
                        $out .= '<th width="13">';
                        $out .= $heading;
                        $out .= '</th>';
                    }
                    else
                    {
                        if($this->expandRow){
                            $z--;
                        }
                        if($this->expandRow && $z == 1)
                        {
                            $out .= '<th width="8">&nbsp;</th>';
                        }
                        if(array_key_exists($heading, $this->width) )
                        {
                            $out .= '<th width="'.$this->width[$heading].'">';
                        }
                        else
                        {
                            $out .= "<th>";
                        }
                        if ( $this->baris != "ALL")
                        {
                            if($z == $this->orderBy)
                            {
                                if ($this->sortBy == "ASC")
                                {
                                    $out .= "<span title=\"Sort By ".$heading." (Z-A)\" orderby=\"$z\" sortby=\"DESC\"".($this->postMethod || $request->input('data-post') ? " data-post = \"TRUE\" data-form = \"#".$this->tbTarget."\" data-screen-loader=\"#screen_".$this->tbTarget."\" data-action = \"".$this->action."\" data-target = \".".$this->tbTarget."\" id =\"orderby\" onclick=\"order($(this));\"" : "").">$heading</span>";
                                }
                                else
                                {
                                    $out .= "<span title=\"Sort By ".$heading." (Z-A)\" orderby=\"$z\" sortby=\"ASC\"".($this->postMethod || $request->input('data-post') ? " data-post = \"TRUE\" data-form = \"#".$this->tbTarget."\" data-screen-loader=\"#screen_".$this->tbTarget."\" data-action = \"".$this->action."\" data-target = \".".$this->tbTarget."\" id =\"orderby\" onclick=\"order($(this));\"" : "")."\>$heading</span>";
                                }
                            }
                            else
                            {
                                if($z > 0)
                                    $out .= "<span title=\"Sort By ".$heading." (Z-A)\" orderby=\"$z\" sortby=\"ASC\"".($this->postMethod || $request->input('data-post') ? " data-post = \"TRUE\" data-form = \"#".$this->tbTarget."\" data-screen-loader=\"#screen_".$this->tbTarget."\" data-action = \"".$this->action."\" data-target = \".".$this->tbTarget."\" id =\"orderby\" onclick=\"order($(this));\"" : "").">$heading</span>";
                                else
                                    $out .= $heading;
                            }
                        }
                        else
                        {
                            $out .= "<span>$heading</span>";
                        }
                        $out .= '</th>';
                    }
                }
            }
        }
        $out .=                     '</thead>';

        if (count($this->rows) > 0)
        {
            $out .= '<tbody '.($this->postMethod ? 'id="body-'.$this->tbTarget.'"': '').'>';
            $i = 1;
            foreach($this->rows as $row)
            {
                if (! is_array($row))
                {
                    break;
                }

                $keyz = "";
                $koma = "";
                foreach ($this->keys as $a)
                {
                    $keyz .= $koma.$row[$a];
                    $koma = ".";
                }
                $name = (fmod($i++, 2)) ? '' : 'alt_';
                if($i%2==0) $cls = 'alt-row';
                else $cls = "main-row";
                if ($this->details=="")
                {
                    $out .= '<tr class="'.$cls.'" urldetil="" id="'.$this->tbTarget.'-'.rand().'">';
                }
                else
                {
                    if ($this->showChk)
                        $out .= '<tr class="'.$cls.'" urldetil="/'.$keyz.'" id="'.$this->tbTarget.'-'.rand().'">';
                    else
                        $out .= '<tr class="'.$cls.'" urldetil="/'.$keyz.'" id="'.$this->tbTarget.'-'.rand().'">';
                }
                $out .= $this->newLine;

                if( $this->showChk )
                {
                    $sId_Td = 'td_'.$this->tbTarget.'_'.rand();
                    $out .= '<td style="width:20px !important;"><div class="center-align"><input type="checkbox" name="tb_chk[]" data-bar = "#panel-top-action_'.$this->tbTarget.'" class="filled-in-custom" id ="'.$sId_Td.'" value="'.$keyz.'" onchange="_chk($(this));"><label for="'.$sId_Td.'"></label></div></td>';
                }

                if ($this->expandRow) $out .= '<td width="8"><a href="javascript:void(0);" id="expand'.$keyz.'" onclick="expand($(this)); return false;" title="Expand baris"><i class="zmdi zmdi-format-valign-center zmdi-hc-fw"></i></a></td>';
                $seq = -1;
                foreach($row as $rowz => $cell)
                {
                    if (!in_array($rowz, $this->hiderows))
                    {
                        if ($this->baris=='ALL' || !$this->showChk) $out .= '<td class="pad12">';
                        else $out .= "<td>";
                        if ($cell === "")
                        {
                            $out .= $this->emptyCell;
                        }
                        else
                        {
                            $cell = str_replace(chr(10), '<br>', $cell);
                            $url_col = $this->columns[$seq];
                            if ( is_array($url_col) )
                            {
                                $new_url_col = $url_col[1];
                                $url_col = explode("{", $new_url_col);
                                foreach($url_col as $x)
                                {
                                    $temp_url_col = explode("}", $x);
                                    $temp_url_col = $temp_url_col[0];
                                    $new_url_col = str_replace("{".$temp_url_col."}", $row[$temp_url_col], $new_url_col);
                                }
                                if(in_array('modal', $this->columns[$seq]))
                                {
                                    $out .= '<a href="javascript:void(0);" data-url = "'.$new_url_col.'" class="modal-link" onclick="modalrow($(this));">'.$cell.'</a>'; #Extend
                                }
                                else if(in_array('replace', $this->columns[$seq]))
                                {
                                    $out .= '<a href="javascript:void(0);" data-url="'.$new_url_col.'" class="replaced" id = "'.rand().'" onclick="fullscdiv($(this));" data-target="#'.$this->columns[$seq][3].'"><small><i class="fa fa-unsorted"></i></small> '.$cell.'</a>';
                                }
                                else if(in_array('append', $this->columns[$seq]))
                                {
                                    $out .= '<a href="javascript:void(0);" data-url = "'.$new_url_col.'" class="append-link" onclick="appendrow($(this));">'.$cell.'</a>'; #End Extend
                                }
                                else{
                                    $out .= '<a href="'.$new_url_col.'">'.$cell.'</a>'; #Default
                                }
                            }
                            else
                            {
                                $out .= $cell;
                            }
                        }
                        $out .= $this->template['cell_'.$name.'end'];
                    }
                    $seq++;
                }

                if($this->setTrId)
                {
                    $attributeRow = $this->attrId;
                    $arrAttribute = explode("{", $attributeRow);
                    foreach($arrAtribute as $attrx)
                    {
                        $tempAttr = explode("}", $attrx);
                        $tempAttr = $tempAttr[0];
                        $attributeRow = str_replace("{".$tempAttr."}", $row[$tempAttr], $attributeRow);
                    }
                    if($this->callBack != "")
                    {
                        $urlCallback = $this->callBack;
                        $tmpCallback = explode("{", $urlCallback);
                        foreach($tmpCallback as $urlCall){
                            $tmpCallbackx = explode("}", $urlCall);
                            $tmpCallbackx = $tmpCallbackx[0];
                            $urlCallback = str_replace("{".$tmpCallbackx."}", $row[$tmpCallbackx], $urlCallback);
                        }
                    }
                    $out .= '<td><a href="javascript:void(0);" id="'.$this->tbTarget.'_'.$i.'" class="tdselect" data-target="'.str_replace('{','',str_replace('}','',$this->attrId)).'" data-retrive = "'.$attributeRow.'" '.($this->callBack!= "" ? "data-url-callback=\"".$urlCallback."\"" : "").' '.($this->callBack!= "" ? "data-field-callback=\"".$this->fieldCallBack."\"" : "").' onclick="selectedrow($(this));"><i class="fa fa-check-square"></i></a></td>';
                }
            }
            $out .= '</tbody>';
        }
        else
        {
            $out .= '<tr><td colspan="'.count($this->heading).'"><center><span class="label label-danger">Record Not Found</span></center></td></tr>';
        }

        $out .=                     $this->template['table_close'];
        $out .=                     '<div class="div-spacer">&nbsp;</div>';

        $out .= '   <input type="hidden" name="tb_hal" value="'.$this->hal.'" /><input type="hidden" name="tb_view" value="'.$this->baris.'" /><input type="hidden" name="orderby" value="'.$this->orderBy.'"><input type="hidden" name="sortby" value="'.$this->sortBy.'">';
        $out .= '<input type="hidden" name="tblang" value="'.$this->lang.'">';
        if ($this->details!="") $out .= '<input type="hidden" id="urldtl" value="'.$this->details.'">';

        /**
         * Block Pagination
         */
        if (count($this->rows) > 0)
        {

            $out .= '       <div class="rowSmartDev">';
            if($this->baris != "ALL")
            {
                $datast = ($this->hal - 1);
                if ( $datast<1 ) $datast = 1;
                else $datast = $datast * $this->baris + 1;
                $dataen = $datast + $this->baris - 1;
                if($iTotalRecord < $dataen) $dataen = $iTotalRecord;
                if($iTotalRecord==0) $datast = 0;
                /**
                 * Navigasi Pagination left
                 */
                $out .= '       <div class="colSmartDev-lg-6 colSmartDev-md-6 colSmartDev-sm-6 colSmartDev-xs-6">';
                $out .= '           <ul class="nav-kiri paginationCustom" style="margin-left:10px;">';
                if($iTotalRecord>=10)
                {
                    if($this->baris==10)
                        $out .= '<li class="active"><a href="javascript:void(0);" class="per" title="Tampilkan 10 Data Per Halaman" '.($this->postMethod || $request->input('data-post') ? " data-post = \"TRUE\" data-form = \"#".$this->tbTarget."\" data-screen-loader=\"#screen_".$this->tbTarget."\" data-action = \"".$this->action."\" data-target = \".".$this->tbTarget."\" id =\"per10\" onclick=\"view($(this));\"" : "").'>10</a></li>';
                    else
                        $out .= '<li class="waves-effect"><a href="javascript:void(0);" class="per" title="Tampilkan 10 Data Per Halaman" '.($this->postMethod || $request->input('data-post') ? " data-post = \"TRUE\" data-form = \"#".$this->tbTarget."\" data-screen-loader=\"#screen_".$this->tbTarget."\" data-action = \"".$this->action."\" data-target = \".".$this->tbTarget."\" id =\"per10\" onclick=\"view($(this));\"" : "").'>10</a></li>';
                }
                if($iTotalRecord>=20)
                {
                    if($this->baris==20)
                        $out .= '<li class="active"><a href="javascript:void(0);" class="per" title="Tampilkan 20 Data Per Halaman" '.($this->postMethod || $request->input('data-post') ? " data-post = \"TRUE\" data-form = \"#".$this->tbTarget."\" data-screen-loader=\"#screen_".$this->tbTarget."\" data-action = \"".$this->action."\" data-target = \".".$this->tbTarget."\" id =\"per20\" onclick=\"view($(this));\"" : "").'>20</a></li>';
                    else
                        $out .= '<li class="waves-effect"><a href="javascript:void(0);" class="per" title="Tampilkan 20 Data Per Halaman" '.($this->postMethod || $request->input('data-post') ? " data-post = \"TRUE\" data-form = \"#".$this->tbTarget."\" data-screen-loader=\"#screen_".$this->tbTarget."\" data-action = \"".$this->action."\" data-target = \".".$this->tbTarget."\" id =\"per20\" onclick=\"view($(this));\"" : "").'>20</a></li>';
                }
                if($iTotalRecord>=50)
                {
                    if($this->baris==50)
                        $out .= '<li class="active"><a href="javascript:void(0);" class="per" title="Tampilkan 50 Data Per Halaman" '.($this->postMethod || $request->input('data-post') ? " data-post = \"TRUE\" data-form = \"#".$this->tbTarget."\" data-screen-loader=\"#screen_".$this->tbTarget."\" data-action = \"".$this->action."\" data-target = \".".$this->tbTarget."\" id =\"per50\" onclick=\"view($(this));\"" : "").'>50</a></li>';
                    else
                        $out .= '<li class="waves-effect"><a href="javascript:void(0);" class="per" title="Tampilkan 50 Data Per Halaman" '.($this->postMethod || $request->input('data-post') ? " data-post = \"TRUE\" data-form = \"#".$this->tbTarget."\" data-screen-loader=\"#screen_".$this->tbTarget."\" data-action = \"".$this->action."\" data-target = \".".$this->tbTarget."\" id =\"per50\" onclick=\"view($(this));\"" : "").'>50</a></li>';
                }
                if($iTotalRecord>=100)
                {
                    if($this->baris==100)
                        $out .= '<li class="active"><a href="javascript:void(0);" class="per" title="Tampilkan 100 Data Per Halaman" '.($this->postMethod || $request->input('data-post') ? " data-post = \"TRUE\" data-form = \"#".$this->tbTarget."\" data-screen-loader=\"#screen_".$this->tbTarget."\" data-action = \"".$this->action."\" data-target = \".".$this->tbTarget."\" id =\"per100\" onclick=\"view($(this));\"" : "").'>100</a></li>';
                    else
                        $out .= '<li class="waves-effect"><a href="javascript:void(0);" class="per" title="Tampilkan 100 Data Per Halaman" '.($this->postMethod || $request->input('data-post') ? " data-post = \"TRUE\" data-form = \"#".$this->tbTarget."\" data-screen-loader=\"#screen_".$this->tbTarget."\" data-action = \"".$this->action."\" data-target = \".".$this->tbTarget."\" id =\"per100\" onclick=\"view($(this));\"" : "").'>100</a></li>';
                }
                if($iTotalRecord!=10 || $iTotalRecord!=20 || $iTotalRecord!=50 || $iTotalRecord!=100)
                {
                    if($iTotalRecord<=100)
                    {
                        if($this->baris==$iTotalRecord)
                        {
                            $out .= '<li class="active"><a href="javascript:void(0);" class="current per" title="Tampilkan '.$iTotalRecord.' Data Per Halaman" '.($this->postMethod || $request->input('data-post') ? " data-post = \"TRUE\" data-form = \"#".$this->tbTarget."\" data-screen-loader=\"#screen_".$this->tbTarget."\" data-action = \"".$this->action."\" data-target = \".".$this->tbTarget."\" id =\"per".$iTotalRecord."\" onclick=\"view($(this));\"" : "").'>'.$iTotalRecord.'</a></li>';
                        }
                        else
                        {
                            $out .= '<li class="waves-effect"><a href="javascript:void(0);" class="per" title="Tampilkan '.$iTotalRecord.' Data Per Halaman" '.($this->postMethod || $request->input('data-post') ? " data-post = \"TRUE\" data-form = \"#".$this->tbTarget."\" data-screen-loader=\"#screen_".$this->tbTarget."\" data-action = \"".$this->action."\" data-target = \".".$this->tbTarget."\" id =\"per".$iTotalRecord."\" onclick=\"view($(this));\"" : "").'>'.$iTotalRecord.'</a></li>';
                        }
                    }
                    else
                    {
                        $out .= '<li class="disabled"><a href="javascript:void(0);" class="disabled" title="Total Data">'.$iTotalRecord.'</a></li>';
                    }
                }
                $out .= '           </ul>';
                $out .= '       </div>';
                /**
                 * End Navigasi Pagination left
                 */
                /**
                 * Navigasi Pagination Right data-screen-loader=\"#screen_".$this->tabTarget."\"
                 */
                $out .= '       <div class="colSmartDev-lg-6 colSmartDev-md-6 colSmartDev-sm-6 colSmartDev-xs-6">';
                $out .= '           <ul class="nav-kanan paginationCustom" style="margin-right:10px;">';
                if($this->hal==1)
                    $out .= '<li class="active"><a href="javascript:void(0);" class="active page" title="Ke Halaman 1" '.($this->postMethod || $request->input('data-post') ? " data-post = \"TRUE\" data-form = \"#".$this->tbTarget."\" data-screen-loader=\"#screen_".$this->tbTarget."\" data-action = \"".$this->action."\" data-target = \".".$this->tbTarget."\" id =\"page-".$this->hal."\" onclick=\"nextprevpage($(this));\"" : "").'>1</a></li>';
                else
                    $out .= '<li class="waves-effect"><a href="javascript:void(0);" class="page" title="Ke Halaman 1" '.($this->postMethod || $request->input('data-post') ? " data-post = \"TRUE\" data-form = \"#".$this->tbTarget."\" data-screen-loader=\"#screen_".$this->tbTarget."\" data-action = \"".$this->action."\" data-target = \".".$this->tbTarget."\" id =\"page-".$this->hal."\" onclick=\"nextprevpage($(this));\"" : "").'>1</a></li>';

                if($this->hal>=6)
                {
                    $out .= '<li class="waves-effect"><a href="#">&hellip; </a></li>';
                    $minnav = $this->hal-2;
                    $maxnav = $this->hal+2;
                }
                else
                {
                    $minnav = 0;
                    $maxnav = 0;
                }
                $countnav = 1;
                for($halnav=2;$halnav<$iTotalCount;$halnav++){
                    if(($minnav==0 && $maxnav==0) || ($halnav>=$minnav && $halnav<=$maxnav))
                    {
                        if($this->hal==$halnav)
                            $out .= '<li class="active"><a href="javascript:void(0);" class="active page" title="Ke Halaman '.$halnav.'" '.($this->postMethod || $request->input('data-post') ? " data-post = \"TRUE\" data-form = \"#".$this->tbTarget."\" data-screen-loader=\"#screen_".$this->tbTarget."\" data-action = \"".$this->action."\" data-target = \".".$this->tbTarget."\" id =\"page-".$halnav."\" onclick=\"nextprevpage($(this));\"" : "").'>'.$halnav.'</a></li>';
                        else
                            $out .= '<li class="waves-effect"><a href="javascript:void(0);" class="page" title="Ke Halaman '.$halnav.'" '.($this->postMethod || $request->input('data-post') ? " data-post = \"TRUE\" data-form = \"#".$this->tbTarget."\" data-screen-loader=\"#screen_".$this->tbTarget."\" data-action = \"".$this->action."\" data-target = \".".$this->tbTarget."\" id =\"page-".$halnav."\" onclick=\"nextprevpage($(this));\"" : "").'>'.$halnav.'</a></li>';
                        $countnav++;
                    }
                    if($countnav==6) break;
                }
                if($iTotalCount>7) $out .= '<li class="waves-effect"><a href="#">&hellip; </a></li>';
                if($iTotalCount>1)
                {
                    if($this->hal==$iTotalCount)
                        $out .= '<li class="active"><a href="javascript:void(0);" class="active page" title="Ke Halaman'.$iTotalCount.'" '.($this->postMethod || $request->input('data-post') ? " data-post = \"TRUE\" data-form = \"#".$this->tbTarget."\" data-screen-loader=\"#screen_".$this->tbTarget."\" data-action = \"".$this->action."\" data-target = \".".$this->tbTarget."\" id =\"page-".$iTotalCount."\" onclick=\"nextprevpage($(this));\"" : "").'>'.$iTotalCount.'</a></li>';
                    else
                        $out .= '<li class="waves-effect"><a href="javascript:void(0);" class="page" title="Ke Halaman '.$iTotalCount.'" '.($this->postMethod || $request->input('data-post') ? " data-post = \"TRUE\" data-form = \"#".$this->tbTarget."\" data-screen-loader=\"#screen_".$this->tbTarget."\" data-action = \"".$this->action."\" data-target = \".".$this->tbTarget."\" id =\"page-".$iTotalCount."\" onclick=\"nextprevpage($(this));\"" : "").'>'.$iTotalCount.'</a></li>';
                }
                $out .= '           </ul>';
                $out .= '       </div>';
                /**
                 * End navigation pagination right
                 */
            }
            $out .= '       </div>';
        }

        /**
         * End Pagination
         */

        $out .=                 '</div>';
        $out .=             '</div>';

        if(!$request->input('data-post'))
        {

        $out .=         '</div>';

        /**
         * End right side
         */

            $out .=     '</div>';
            $out .= '</div>';
        }


        /**
         * End Containers Row
         */


        #End Form
        $out .= '   </form>';
        $out .= '</div>';


        if(!$request->input('data-post')) {
            $out .= '   <div class="rowSmartDev">
                        <div class="colSmartDev-lg-12 colSmartDev-md-12 colSmartDev-sm-12 colSmartDev-xs-12">
                            <div class="panel-top-action" id="panel-top-action_'. $this->tbTarget .'">
                            <div class="action-left">
                                <a href="javascript:void(0)" onclick="_hideBottom($(this));" id="'.rand().'" class="btnSmartDev btnSmartDev-outline-primary" title="Back or Close" data-body = ".'.$this->tbTarget.'" data-bar="#panel-top-action_'.$this->tbTarget.'" style="margin-right: 30px; margin-left: 5px;"><i class="'. $this->iconCustoms['panel-top-close'] .'"></i></a> &nbsp;';
            if(count($this->proses) > 0 && $this->showChk)
            {
                foreach($this->proses as $a => $b)
                {
                    if(!array_key_exists($a, $arrSubHome)){
                        $out .= '<a href="javascript:void(0);" title="'.$a.'" class="btnSmartDev btnSmartDev-outline-primary tbs_menu" met="'.$b[0].'" jml="'.$b[2].'" url="'.$b[1].'"'.(strlen($b[4]) > 0 ? 'isngajax = "true" data-form = "#'.$this->tbTarget.'"' : ""). (strlen(trim($b[5])) > 0 ? 'data-body = "'.$b[4].'"' : ''). ' ><i class="'.$b[3].'"></i></a> &nbsp;';
                    }
                }
            }
            $out .= '           <div class="selected_items"><span></span></div>
                            </div>
                            </div>
                        </div>';
            $out .= '   <div>';
        }


        #End print table component

        if($this->divAppend)
        {
			$out .= '<div class="rowSmartDev" id="newdiv"></div>';
        }

        return $out;
    }

    public function clear()   
    {
        $this->heading      = array();
        $this->rows         = array();
        $this->autoHeading  = TRUE;
    }

    public function setFromObject($query)
    {
        if(count($this->heading) == 0)
        {
            empty($this->heading);
            if($this->showChk) $this->heading[] = '<div class="center-align"><input type="checkbox" class="filled-in-custom"'.($this->postMethod ? 'class="chkall'.$this->tbTarget.'" onchange="_chkall($(this));" id ="chkall'.$this->tbTarget.'" data-bar = "#panel-top-action_'.$this->tbTarget.'" data-body = "#body-'.$this->tbTarget.'" ': 'id="tb_chkall').'><label for="'.($this->postMethod ? 'chkall'.$this->tbTarget : 'tb_chkall').'"></label></div>';
            if($this->expandRow) $this->heading[] = '&nbsp';
            if($this->list_fields($query) != FALSE)
            {
                foreach($this->list_fields($query) as $a)
                {
                    $this->heading[] = $a;
                }
            }
            if($this->setTrId) $this->heading[] = '&nbsp;';
        }
        if(sizeof($query) > 0)
        {
            foreach($query as $row)
            {
                $this->rows[] = (array)$row;
            }
        }
    }

    public function list_fields($dbObjects)
    {
        if(sizeof($dbObjects) > 0)
            return array_keys((array)$dbObjects[0]);
        else
            return FALSE;
    }

    public function setFromArray($data, $setHeading = TRUE)
    {
        if(!is_array($data) OR count($data) == 0)
        {
            return FALSE;
        }
        $i = 0;
        foreach($data as $row) 
        {
            if(!is_array($row))
            {
                $this->rows[] = $row;
                break;
            }
            if($i == 0 AND count($data) > 1 AND count($this->heading) == 0 AND $setHeading = TRUE)
            {
                $this->heading[] = $row;
            }
            else
            {
                $this->rows[] = $row;
            }
            $i++;
        }
    }

    public function compileTemplate()
    {
        if($this->template == NULL)
        {
            $this->template = $this->defaultTemplate();
            return;
        }
        $this->temp = $this->defaultTemplate();
        foreach (array('table_open','heading_row_start', 'heading_row_end', 'heading_cell_start', 'heading_cell_end', 'row_start', 'row_end', 'cell_start', 'cell_end', 'row_alt_start', 'row_alt_end', 'cell_alt_start', 'cell_alt_end', 'table_close') as $val)
		{
			if ( ! isset($this->template[$val]))
			{
				$this->template[$val] = $this->temp[$val];
			}
		}
    }

    public function defaultTemplate()
    {
        return [
            'table_open'                => '<table class="smartDevTable">',
            'heading_row_start'         => '<tr>',
            'heading_row_end'           => '</tr>',
            'heading_cell_start'        => '<th>',
            'heading_cell_end'          => '</th>',
            'row_start'                 => '<tr>',
            'row_end'                   => '</tr>',
            'cell_start'                => '<td>',
            'cell_end'                  => '</td>',
            'row_alt_start'             => '<tr>',
            'row_alt_end'               => '</tr>',
            'cell_alt_start'            => '<td>',
            'cell_alt_end'              => '</td>',
            'table_close'               =>  '</table>'
        ];
    }

}