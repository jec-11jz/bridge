function jump(){var url=document.form1.select.options[document.form1.select.selectedIndex].val();url!=""&&(target=="top"?top.location.href=url:target=="blank"?window.open(url,"window_name"):target!=""?eval("parent."+target+".location.href = url"):location.href=url)}var target="";