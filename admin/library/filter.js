// JavaScript Document
function getXmlHttp() {
    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function checkFilterForm()
{
    with (window.document.frmFilter) {
		if (isEmpty(txtName, 'Введите имя фильтра')) {
			return;
		} else {
			submit();
		}
	}
}

function checkValueForm()
{
    with (window.document.frmValue) {
        if (isEmpty(txtValue, 'Введите значение фильтра')) {
                   return;
        }
        else {
            submit();
        }
    }
}

function addFilter()
{
	window.location.href = 'index.php?view=addFilter';
}

function addValue()
{
    window.location.href = 'index.php?view=addValue';
}

function modifyFilter(fltId)
{
	window.location.href = 'index.php?view=modify&fltId=' + fltId;
}

function deleteFilter(fltId)
{
	if (confirm('Вы точно хотите удалить этот фильтр?')) {
		window.location.href = 'processFilter.php?action=delete&fltId=' + fltId;
	}
}

function modifyValue(valId)
{
    window.location.href = 'index.php?view=modifyValue&valId=' + valId;
}

function deleteValue(valId)
{
    if (confirm('Вы точно хотите удалить это значение?')) {
        window.location.href = 'processFilter.php?action=deleteValue&valId=' + valId;
    }
}

function viewFilter()
{
    with (window.document.frmListFilter) {
        if (cboFilter.value == 0) {
            window.location.href = 'index.php?sort=id';
        } else {
            window.location.href = 'index.php?sort=name';
        }
    }
}