<?php

namespace App\Helpers;

use Codedge\Fpdf\Fpdf\Fpdf;


class Pdf extends FPDF
{
	// Page header
	function Header()
	{
		//Header
		$this->Image(asset('images/logo/logo3.jpeg'), 7, 5, 45);
		$this->Ln(23);
	}

}
