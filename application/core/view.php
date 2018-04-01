<?
class View
{
	function generate($content_view, $result = null, $total = null, $page = null)
	{	
        include 'application/views/'.$content_view;
	}
}