function nwindow(url)
{
	win=window.open(url, 'a1', 'left=100,top=100,toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,height=500,width=450');
	win.focus();
}

function show_banner(id)
{
	var left_class, center_class, right_class, height;
	for (i = 0; i < arr_banners.length; i++)
	{
		if (arr_banners[i] == id)
		{
			if (i == 0)
			{
				left_class = "banner_left_top_active";
				center_class = "banner_center_top_active";
				right_class = "banner_right_top_active";
			}
			if (i == (arr_banners.length - 1))
			{
				left_class = "banner_left_bottom_active";
				center_class = "banner_center_bottom_active";
				right_class = "banner_right_bottom_active";
			}
			if (i > 0 && i < (arr_banners.length - 1))
			{
				left_class = "banner_left_active";
				center_class = "banner_center_active";
				right_class = "banner_right_active";
			}
			height = height_active;
			document.getElementById("banner_" + arr_banners[i]).style.display = "block";
			document.getElementById("anons_" + arr_banners[i]).style.display = "block";
		}
		else
		{
			if (i == 0)
			{
				left_class = "banner_left_top";
				center_class = "banner_center_top";
				right_class = "banner_right_top";
			}
			if (i == (arr_banners.length - 1))
			{
				left_class = "banner_left_bottom";
				center_class = "banner_center_bottom";
				right_class = "banner_right_bottom";
			}
			if (i > 0 && i < (arr_banners.length - 1))
			{
				left_class = "banner_left";
				center_class = "banner_center";
				right_class = "banner_right";
			}
			height = height_inactive;
			document.getElementById("banner_" + arr_banners[i]).style.display = "none";
			document.getElementById("anons_" + arr_banners[i]).style.display = "none";
		}
		//alert(arr_banners.length - 1);
		//alert(left_class + "  " + center_class + "  " );
		
		document.getElementById("left_" + arr_banners[i]).style.height = height;
		document.getElementById("center_" + arr_banners[i]).style.height = height;
		document.getElementById("right_" + arr_banners[i]).style.height = height;
		
		document.getElementById("left_" + arr_banners[i]).className = left_class;
		document.getElementById("center_" + arr_banners[i]).className = center_class;
		document.getElementById("right_" + arr_banners[i]).className = right_class;
	}
}

function SearchFocus()
{
	if (document.getElementById("searchword").value == "поиск...")
		document.getElementById("searchword").value = "";
}

function SearchBlur()
{
	if (document.getElementById("searchword").value == "")
		document.getElementById("searchword").value = "поиск...";
}