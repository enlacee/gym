/* 
 * grid responsibe
 * @url = http://stackoverflow.com/questions/2686043/correctly-calling-setgridwidth-on-a-jqgrid-inside-a-jqueryui-dialog
 */
var fixGridWidth = function (grid) {
    var gviewScrollWidth = grid[0].parentNode.parentNode.parentNode.scrollWidth;
    var mainWidth = jQuery('#main').width();
    var gridScrollWidth = grid[0].scrollWidth;
    var htable = jQuery('table.ui-jqgrid-htable', grid[0].parentNode.parentNode.parentNode);
    var scrollWidth = gridScrollWidth;
    if (htable.length > 0) {
        var hdivScrollWidth = htable[0].scrollWidth;
        if ((gridScrollWidth < hdivScrollWidth))
            scrollWidth = hdivScrollWidth; // max (gridScrollWidth, hdivScrollWidth)
    }
    if (gviewScrollWidth != scrollWidth || scrollWidth > mainWidth) {
        var newGridWidth = (scrollWidth <= mainWidth)? scrollWidth: mainWidth;  // min (scrollWidth, mainWidth)
        // if the grid has no data, gridScrollWidth can be less then hdiv[0].scrollWidth
        if (newGridWidth != gviewScrollWidth)
            grid.jqGrid("setGridWidth", newGridWidth);
    }
};

var fixGridHeight = function (grid) {
    var gviewNode = grid[0].parentNode.parentNode.parentNode;
    //var gview = grid.parent().parent().parent();
    //var bdiv = jQuery("#gview_" + grid[0].id + " .ui-jqgrid-bdiv");
    var bdiv = jQuery(".ui-jqgrid-bdiv", gviewNode);
    if (bdiv.length) {
        var delta = bdiv[0].scrollHeight - bdiv[0].clientHeight;
        var height = grid.height();
        if (delta !== 0 && height && (height-delta>0)) {
            grid.setGridHeight(height-delta);
        }
    }
};

var fixGridSize = function (grid) {
    this.fixGridWidth(grid);
    this.fixGridHeight(grid);
};