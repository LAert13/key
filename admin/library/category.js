// JavaScript Document
function checkCategoryForm()
{
    with (window.document.frmCategory) {
		if (isEmpty(txtName, 'Enter category name')) {
			return;
		} else if (isEmpty(mtxDescription, 'Enter category description')) {
			return;
		} else {
			submit();
		}
	}
}

function addCategory(parentId)
{
	targetUrl = 'index.php?view=add';
	if (parentId != 0) {
		targetUrl += '&parentId=' + parentId;
	}
	
	window.location.href = targetUrl;
}

function modifyCategory(catId)
{
	window.location.href = 'index.php?view=modify&catId=' + catId;
}

function changeCatFilters(catId)
{
    window.location.href = 'index.php?view=modifyFilters&catId=' + catId;
}

function deleteCategory(catId)
{
	if (confirm('Deleting category will also delete all products in it.\nContinue anyway?')) {
		window.location.href = 'processCategory.php?action=delete&catId=' + catId;
	}
}

function deleteCatImage(catId)
{
	if (confirm('Delete this image?')) {
		window.location.href = 'processCategory.php?action=deleteImage&catId=' + catId;
	}
}

function add_filter_input(obj) {
    var new_input=document.createElement('div');
    var number=document.getElementById('inputi').getElementsByTagName('div').length;
    var xmlhttp = getXmlHttp();
    xmlhttp.open('POST', 'processCategory.php?action=filterSelect', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send("num=" + encodeURIComponent(number));
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            if(xmlhttp.status == 200) {
                new_input.innerHTML = xmlhttp.responseText;
                new_input.innerHTML=new_input.innerHTML+'<input type="button" value="-" onclick="del_input(this.parentNode)">';
                document.getElementById('inputi').appendChild(new_input);
            }
        }
    };
}

function del_input(obj) {
    document.getElementById('inputi').removeChild(obj)
}

function deleteCategoryFilter(catId, filterId)
{
    if (confirm('Удалить этот фильтр?')) {
        window.location.href = 'processCategory.php?action=deleteCategoryFilter&catId=' + catId + '&filterId=' + filterId;
    }
}
function moveUpCategoryFilter(catId, filterId)
{
    window.location.href = 'processCategory.php?action=upCategoryFilter&catId=' + catId + '&filterId=' + filterId;
}

function moveDownCategoryFilter(catId, filterId)
{
    window.location.href = 'processCategory.php?action=downCategoryFilter&catId=' + catId + '&filterId=' + filterId;
}
