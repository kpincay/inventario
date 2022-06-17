// JavaScript Document	$(function () {
var data = [
    { rank: 1, company: 'Exxon Mobil', revenues: '339938.0', profits: '36130.0' },
    { rank: 2, company: 'Wal-Mart Stores', revenues: '315654.0', profits: '11231.0' },
    { rank: 3, company: 'Royal Dutch Shell', revenues: '306731.0', profits: '25311.0' },
    { rank: 4, company: 'BP', revenues: '267600.0', profits: '22341.0' },
    { rank: 5, company: 'General Motors', revenues: '192604.0', profits: '-10567.0' },
    { rank: 6, company: 'Chevron', revenues: '189481.0', profits: '14099.0' },
    { rank: 7, company: 'DaimlerChrysler', revenues: '186106.3', profits: '3536.3' },
    { rank: 8, company: 'Toyota Motor', revenues: '185805.0', profits: '12119.6' },
    { rank: 9, company: 'Ford Motor', revenues: '177210.0', profits: '2024.0' },
    { rank: 10, company: 'ConocoPhillips', revenues: '166683.0', profits: '13529.0' },
    { rank: 11, company: 'General Electric', revenues: '157153.0', profits: '16353.0' },
];
var modelo = [
    { title: "Rank", dataType: "integer", dataIndx: "rank", minWidth: 50, resizable: false },
    { title: "Company", dataType: "string", dataIndx: "company", width: '38' },
    { title: "Revenues ($ millions)", dataType: "float", align: "right", dataIndx: "revenues" },
    { title: "Profits ($ millions)", dataType: "float", align: "right", dataIndx: "profits" }
];

var rows = 500,
    cols = 100,
    toLetter = pq.toLetter,
    //generateData = pq.generateData,
    //data:data,
    //data = generateData(rows, cols),
    colModel = [];

/* for (var i = 0; i < cols; i++) {
     colModel[i] = { title: toLetter(i), width: 70 };
 }*/

//define common toolbar for both grids.
var toolbar = {
    items: [{
            type: 'button',
            label: 'Cut',
            listener: function() {
                this.cut();
            }
        },
        {
            type: 'button',
            label: 'Copy',
            listener: function() {
                this.copy();
            }
        },
        {
            type: 'button',
            label: 'Paste',
            listener: function() {
                this.paste();
            }
        }
    ]
};
//create first grid.
$("#grid_json_copy").pqGrid({
colModel: modelo,
dataModel: { data: data },
width: "100%",
height: 400,
toolbar: toolbar,
virtualX: true,
virtualY: true,
selectionModel: { column: true },
mergeCells: [
    { r1: 1, c1: 2, rc: 4, cc: 3 }
],
title: "Grid From JSON",
showBottom: false,
editModel: { clicksToEdit: 2 },
scrollModel: { autoFit: true },
location: "local",
sorting: "local",
sortIndx: "profits",
sortDir: "down"

});

//create 2nd grid.
/*$("#grid_json_paste").pqGrid({
    colModel: $.extend(true, [], colModel ),
    width: '48%-2',
    title: "Grid B",
    toolbar: toolbar,
    virtualX: true, virtualY: true,            
    selectionModel: { column: true },           
    mergeCells: [
        { r1: 1, c1: 2, rc: 4, cc: 3 }
    ]
});*/
});