function getnavi(){req=new XMLHttpRequest;req.onload=shownavi;req.open("GET","");req.send()}function shownavi(){ret=req.responseText;navi_obj=document.getElementById("v_navi");navi_obj.innerHTML=ret}var req=null;