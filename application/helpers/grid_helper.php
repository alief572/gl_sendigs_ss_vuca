<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

		
		function history_user($desc=NULL){
			$CI =& get_instance();
			$path	= $CI->uri->segment(1);
			$userID	= $CI->session->userdata('ses_username');
			$Date	= date('Y-m-d H:i:s');

			$DataHistory=array();
			$DataHistory['user_id']		= $userID;
			$DataHistory['path']		= $path;
			$DataHistory['description']	= $desc;
			$DataHistory['created']		= $Date;
			$CI->db->insert('histories',$DataHistory);
		}


		function getRomawi($bulan){
			$month	= intval($bulan);
			switch($month){
				case "1":
					$romawi	='I';
					break;
				case "2":
					$romawi	='II';
					break;
				case "3":
					$romawi	='III';
					break;
				case "4":
					$romawi	='IV';
					break;
				case "5":
					$romawi	='V';
					break;
				case "6":
					$romawi	='VI';
					break;
				case "7":
					$romawi	='VII';
					break;
				case "8":
					$romawi	='VIII';
					break;
				case "9":
					$romawi	='IX';
					break;
				case "10":
					$romawi	='X';
					break;
				case "11":
					$romawi	='XI';
					break;
				case "12":
					$romawi	='XII';
					break;
			}
			return $romawi;
		}

		function getColsChar($colums)
		{
			// Palleng by jester

			if($colums>26)
			{
				$modCols = floor($colums/26);
				$ExCols = $modCols*26;
				$totCols = $colums-$ExCols;

				if($totCols==0)
				{
					$modCols=$modCols-1;
					$totCols+=26;
				}

				$lets1 = getLetColsLetter($modCols);
				$lets2 = getLetColsLetter($totCols);
				return $letsi = $lets1.$lets2;
			}
			else
			{
				$lets = getLetColsLetter($colums);
				return $letsi = $lets;
			}
		}

		function getLetColsLetter($numbs){
		// Palleng by jester
			switch($numbs){
				case 1:
				$Chars = 'A';
				break;
				case 2:
				$Chars = 'B';
				break;
				case 3:
				$Chars = 'C';
				break;
				case 4:
				$Chars = 'D';
				break;
				case 5:
				$Chars = 'E';
				break;
				case 6:
				$Chars = 'F';
				break;
				case 7:
				$Chars = 'G';
				break;
				case 8:
				$Chars = 'H';
				break;
				case 9:
				$Chars = 'I';
				break;
				case 10:
				$Chars = 'J';
				break;
				case 11:
				$Chars = 'K';
				break;
				case 12:
				$Chars = 'L';
				break;
				case 13:
				$Chars = 'M';
				break;
				case 14:
				$Chars = 'N';
				break;
				case 15:
				$Chars = 'O';
				break;
				case 16:
				$Chars = 'P';
				break;
				case 17:
				$Chars = 'Q';
				break;
				case 18:
				$Chars = 'R';
				break;
				case 19:
				$Chars = 'S';
				break;
				case 20:
				$Chars = 'T';
				break;
				case 21:
				$Chars = 'U';
				break;
				case 22:
				$Chars = 'V';
				break;
				case 23:
				$Chars = 'W';
				break;
				case 24:
				$Chars = 'X';
				break;
				case 25:
				$Chars = 'Y';
				break;
				case 26:
				$Chars = 'Z';
				break;
			}

			return $Chars;
		}

		function getColsLetter($char){
		//	Palleng by jester
			$len = strlen($char);
			if($len==1)
			{
				$numb = getLetColsNumber($char);
			}
			elseif($len==2)
			{
				$i=1;
				$j=0;
				$jm=1;
				while($i<$len)
				{
					$let_fst = substr($char, $j,1);
					$dv = getLetColsNumber($let_fst);
					$jm = $dv * 26;

					$i++;
					$j++;
				}
				$let_last = substr($char, $j,1);
				$numb = $jm + getLetColsNumber($let_last);
			}

			return $numb;
		}

		function getLetColsNumber($char)
		{
			// Palleng by jester

			switch($char){
				case 'A':$numb = 1;break;
				case 'B':$numb = 2;break;
				case 'C':$numb = 3;break;
				case 'D':$numb = 4;break;
				case 'E':$numb = 5;break;
				case 'F':$numb = 6;break;
				case 'G':$numb = 7;break;
				case 'H':$numb = 8;break;
				case 'I':$numb = 9;break;
				case 'J':$numb = 10;break;
				case 'K':$numb = 11;break;
				case 'L':$numb = 12;break;
				case 'M':$numb = 13;break;
				case 'N':$numb = 14;break;
				case 'O':$numb = 15;break;
				case 'P':$numb = 16;break;
				case 'Q':$numb = 17;break;
				case 'R':$numb = 18;break;
				case 'S':$numb = 19;break;
				case 'T':$numb = 20;break;
				case 'U':$numb = 21;break;
				case 'V':$numb = 22;break;
				case 'W':$numb = 23;break;
				case 'X':$numb = 24;break;
				case 'Y':$numb = 25;break;
				case 'Z':$numb = 26;break;
			}

			return $numb;
		}

		function implode_data($data=array(),$key='key'){
			if(strtolower($key)=='key'){
				$det_imp	="";
				foreach($data as $key=>$val){
					if(!empty($det_imp))$det_imp.="','";
					$det_imp	.=$key;
				}
			}else{
				$det_imp	=implode("','",$data);
			}
			return $det_imp;
		}
		function getExtension($str) {
			 $i = strrpos($str,".");
			 if (!$i) { return ""; }

			 $l = strlen($str) - $i;
			 $ext = substr($str,$i+1,$l);
			 return $ext;
		}
		
		function create_Cabang(){
			$CI 			=& get_instance();
			$det_Return		= array();
			$Query_Cabang	= "SELECT nocab,subcab,cabang FROM pastibisa_tb_cabang ORDER BY nocab ASC";
			$records		= $CI->db->query($Query_Cabang)->result();
			if($records){
				foreach($records as $keyR=>$valR){
					$kode_Cabang				= $valR->nocab;
					$Cabang						= $valR->cabang;
					$det_Return[$kode_Cabang]	= $Cabang;
				}
			}
			return $det_Return;
			
		}
		
?>
