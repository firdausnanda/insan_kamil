<?php

namespace App\Helpers;

use Codedge\Fpdf\Fpdf\Fpdf;


class Pdf extends FPDF
{
	// Page header
	function Header()
	{
		//Header
		// Kertas A5
		// $this->Image(asset('images/logo/logo3.jpeg'), 10, 5, 30);
		// $this->Ln(14);

		// Kertas 100 mm x 150 mm
		$this->Image(asset('images/logo/logo3.jpeg'), 3, 3, 20);
		$this->Ln(14);
	}
	
	function GetMultiCellHeight($w, $h, $txt, $border=null, $align='J') {
		// Calculate MultiCell with automatic or explicit line breaks height
		// $border is un-used, but I kept it in the parameters to keep the call
		//   to this function consistent with MultiCell()
		$cw = &$this->CurrentFont['cw'];
		if($w==0)
			$w = $this->w-$this->rMargin-$this->x;
		$wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
		$s = str_replace("\r",'',$txt);
		$nb = strlen($s);
		if($nb>0 && $s[$nb-1]=="\n")
			$nb--;
		$sep = -1;
		$i = 0;
		$j = 0;
		$l = 0;
		$ns = 0;
		$height = 0;
		while($i<$nb)
		{
			// Get next character
			$c = $s[$i];
			if($c=="\n")
			{
				// Explicit line break
				if($this->ws>0)
				{
					$this->ws = 0;
					$this->_out('0 Tw');
				}
				//Increase Height
				$height += $h;
				$i++;
				$sep = -1;
				$j = $i;
				$l = 0;
				$ns = 0;
				continue;
			}
			if($c==' ')
			{
				$sep = $i;
				$ls = $l;
				$ns++;
			}
			$l += $cw[$c];
			if($l>$wmax)
			{
				// Automatic line break
				if($sep==-1)
				{
					if($i==$j)
						$i++;
					if($this->ws>0)
					{
						$this->ws = 0;
						$this->_out('0 Tw');
					}
					//Increase Height
					$height += $h;
				}
				else
				{
					if($align=='J')
					{
						$this->ws = ($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
						$this->_out(sprintf('%.3F Tw',$this->ws*$this->k));
					}
					//Increase Height
					$height += $h;
					$i = $sep+1;
				}
				$sep = -1;
				$j = $i;
				$l = 0;
				$ns = 0;
			}
			else
				$i++;
		}
		// Last chunk
		if($this->ws>0)
		{
			$this->ws = 0;
			$this->_out('0 Tw');
		}
		//Increase Height
		$height += $h;
	
		return $height;
	}
}
