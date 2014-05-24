// JavaScript Document
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