<?php

namespace App\Helpers;

use Codedge\Fpdf\Fpdf\Fpdf;


class Pdf extends FPDF
{
	// Page header
	function Header()
	{
		//Header
		$this->Image(asset('images/logo/logo3.jpeg'), 10, 5, 30);
		$this->Ln(14);
	}

}
