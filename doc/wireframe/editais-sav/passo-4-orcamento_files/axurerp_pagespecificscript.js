
var PageName = 'passo-4-orcamento';
var PageId = '8fc1c1b0c7664979abff2e52e5938f33'
var PageUrl = 'passo-4-orcamento.html'
document.title = 'passo-4-orcamento';
var PageNotes = 
{
"pageName":"passo-4-orcamento",
"showNotesNames":"False"}
var $OnLoadVariable = '';

var $PostText = '';

var $NumPosts = '';

var $RatingMade = '';

var $ItemTitle = '';

var $NewVariable1 = '';

var $CSUM;

var hasQuery = false;
var query = window.location.hash.substring(1);
if (query.length > 0) hasQuery = true;
var vars = query.split("&");
for (var i = 0; i < vars.length; i++) {
    var pair = vars[i].split("=");
    if (pair[0].length > 0) eval("$" + pair[0] + " = decodeURIComponent(pair[1]);");
} 

if (hasQuery && $CSUM != 1) {
alert('Prototype Warning: The variable values were too long to pass to this page.\nIf you are using IE, using Firefox will support more data.');
}

function GetQuerystring() {
    return '#OnLoadVariable=' + encodeURIComponent($OnLoadVariable) + '&PostText=' + encodeURIComponent($PostText) + '&NumPosts=' + encodeURIComponent($NumPosts) + '&RatingMade=' + encodeURIComponent($RatingMade) + '&ItemTitle=' + encodeURIComponent($ItemTitle) + '&NewVariable1=' + encodeURIComponent($NewVariable1) + '&CSUM=1';
}

function PopulateVariables(value) {
    var d = new Date();
  value = value.replace(/\[\[OnLoadVariable\]\]/g, $OnLoadVariable);
  value = value.replace(/\[\[PostText\]\]/g, $PostText);
  value = value.replace(/\[\[NumPosts\]\]/g, $NumPosts);
  value = value.replace(/\[\[RatingMade\]\]/g, $RatingMade);
  value = value.replace(/\[\[ItemTitle\]\]/g, $ItemTitle);
  value = value.replace(/\[\[NewVariable1\]\]/g, $NewVariable1);
  value = value.replace(/\[\[PageName\]\]/g, PageName);
  value = value.replace(/\[\[GenDay\]\]/g, '2');
  value = value.replace(/\[\[GenMonth\]\]/g, '9');
  value = value.replace(/\[\[GenMonthName\]\]/g, 'September');
  value = value.replace(/\[\[GenDayOfWeek\]\]/g, 'Friday');
  value = value.replace(/\[\[GenYear\]\]/g, '2011');
  value = value.replace(/\[\[Day\]\]/g, d.getDate());
  value = value.replace(/\[\[Month\]\]/g, d.getMonth() + 1);
  value = value.replace(/\[\[MonthName\]\]/g, GetMonthString(d.getMonth()));
  value = value.replace(/\[\[DayOfWeek\]\]/g, GetDayString(d.getDay()));
  value = value.replace(/\[\[Year\]\]/g, d.getFullYear());
  return value;
}

function OnLoad(e) {

}

var u270 = document.getElementById('u270');

u270.style.cursor = 'pointer';
if (bIE) u270.attachEvent("onclick", Clicku270);
else u270.addEventListener("click", Clicku270, true);
function Clicku270(e)
{
windowEvent = e;


if ((GetCheckState('u270')) == (true)) {

	MoveWidgetBy('u98',0,50,'swing',500);

	MoveWidgetBy('u139',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u270')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u98',0,-50,'swing',500);

	MoveWidgetBy('u139',0,-50,'swing',500);

}

}

var u271 = document.getElementById('u271');
gv_vAlignTable['u271'] = 'top';
var u272 = document.getElementById('u272');

var u273 = document.getElementById('u273');

var u274 = document.getElementById('u274');
gv_vAlignTable['u274'] = 'center';
var u275 = document.getElementById('u275');
gv_vAlignTable['u275'] = 'top';
var u276 = document.getElementById('u276');
gv_vAlignTable['u276'] = 'top';
var u277 = document.getElementById('u277');
gv_vAlignTable['u277'] = 'top';
var u278 = document.getElementById('u278');

var u279 = document.getElementById('u279');

var u280 = document.getElementById('u280');
gv_vAlignTable['u280'] = 'center';
var u281 = document.getElementById('u281');
gv_vAlignTable['u281'] = 'top';
var u282 = document.getElementById('u282');

var u283 = document.getElementById('u283');

var u284 = document.getElementById('u284');
gv_vAlignTable['u284'] = 'center';
var u285 = document.getElementById('u285');

var u286 = document.getElementById('u286');
gv_vAlignTable['u286'] = 'center';
var u287 = document.getElementById('u287');

var u288 = document.getElementById('u288');

var u289 = document.getElementById('u289');
gv_vAlignTable['u289'] = 'center';
var u490 = document.getElementById('u490');
gv_vAlignTable['u490'] = 'top';
var u491 = document.getElementById('u491');

var u492 = document.getElementById('u492');

var u493 = document.getElementById('u493');

var u494 = document.getElementById('u494');

if (bIE) u494.attachEvent("onblur", LostFocusu494);
else u494.addEventListener("blur", LostFocusu494, true);
function LostFocusu494(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u495', '' + (GetWidgetFormText('u493') * GetWidgetFormText('u494')) + '');

}

}

var u495 = document.getElementById('u495');

var u496 = document.getElementById('u496');
gv_vAlignTable['u496'] = 'top';
var u100 = document.getElementById('u100');

var u101 = document.getElementById('u101');

var u102 = document.getElementById('u102');

var u103 = document.getElementById('u103');

if (bIE) u103.attachEvent("onblur", LostFocusu103);
else u103.addEventListener("blur", LostFocusu103, true);
function LostFocusu103(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u104', '' + (GetWidgetFormText('u101') * GetWidgetFormText('u103')) + '');

}

}

var u104 = document.getElementById('u104');

var u105 = document.getElementById('u105');
gv_vAlignTable['u105'] = 'top';
var u106 = document.getElementById('u106');
gv_vAlignTable['u106'] = 'top';
var u107 = document.getElementById('u107');
gv_vAlignTable['u107'] = 'top';
var u108 = document.getElementById('u108');
gv_vAlignTable['u108'] = 'top';
var u109 = document.getElementById('u109');
gv_vAlignTable['u109'] = 'top';
var u297 = document.getElementById('u297');

var u298 = document.getElementById('u298');
gv_vAlignTable['u298'] = 'top';
var u299 = document.getElementById('u299');

var u500 = document.getElementById('u500');
gv_vAlignTable['u500'] = 'top';
var u392 = document.getElementById('u392');

var u9 = document.getElementById('u9');
gv_vAlignTable['u9'] = 'top';
var u110 = document.getElementById('u110');

var u111 = document.getElementById('u111');

u111.style.cursor = 'pointer';
if (bIE) u111.attachEvent("onclick", Clicku111);
else u111.addEventListener("click", Clicku111, true);
function Clicku111(e)
{
windowEvent = e;


if (true) {

	MoveWidgetBy('u139',0,50,'swing',500);

	SetPanelVisibility('u99','hidden','none',500);

	SetPanelVisibility('u114','','fade',500);

}

}
gv_vAlignTable['u111'] = 'top';
var u112 = document.getElementById('u112');

u112.style.cursor = 'pointer';
if (bIE) u112.attachEvent("onclick", Clicku112);
else u112.addEventListener("click", Clicku112, true);
function Clicku112(e)
{
windowEvent = e;


if ((GetCheckState('u112')) == (true)) {

	MoveWidgetBy('u139',0,50,'swing',500);

	SetPanelVisibility('u99','','fade',500);

}
else
if ((GetCheckState('u112')) == (false)) {

	SetPanelVisibility('u99','hidden','none',500);

	SetPanelVisibility('u114','hidden','none',500);

	MoveWidgetBy('u139',0,-50,'swing',500);

}

}

var u113 = document.getElementById('u113');
gv_vAlignTable['u113'] = 'top';
var u114 = document.getElementById('u114');

var u115 = document.getElementById('u115');

var u116 = document.getElementById('u116');

var u117 = document.getElementById('u117');

var u118 = document.getElementById('u118');

if (bIE) u118.attachEvent("onblur", LostFocusu118);
else u118.addEventListener("blur", LostFocusu118, true);
function LostFocusu118(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u119', '' + (GetWidgetFormText('u116') * GetWidgetFormText('u118')) + '');

}

}

var u119 = document.getElementById('u119');

var u510 = document.getElementById('u510');
gv_vAlignTable['u510'] = 'top';
var u32 = document.getElementById('u32');
gv_vAlignTable['u32'] = 'center';
var u33 = document.getElementById('u33');

var u34 = document.getElementById('u34');
gv_vAlignTable['u34'] = 'center';
var u35 = document.getElementById('u35');

var u120 = document.getElementById('u120');
gv_vAlignTable['u120'] = 'top';
var u121 = document.getElementById('u121');
gv_vAlignTable['u121'] = 'top';
var u122 = document.getElementById('u122');
gv_vAlignTable['u122'] = 'top';
var u123 = document.getElementById('u123');
gv_vAlignTable['u123'] = 'top';
var u124 = document.getElementById('u124');
gv_vAlignTable['u124'] = 'top';
var u125 = document.getElementById('u125');

var u126 = document.getElementById('u126');

var u127 = document.getElementById('u127');

var u128 = document.getElementById('u128');

var u129 = document.getElementById('u129');

if (bIE) u129.attachEvent("onblur", LostFocusu129);
else u129.addEventListener("blur", LostFocusu129, true);
function LostFocusu129(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u130', '' + (GetWidgetFormText('u127') * GetWidgetFormText('u129')) + '');

}

}

var u130 = document.getElementById('u130');

var u131 = document.getElementById('u131');
gv_vAlignTable['u131'] = 'top';
var u132 = document.getElementById('u132');
gv_vAlignTable['u132'] = 'top';
var u133 = document.getElementById('u133');
gv_vAlignTable['u133'] = 'top';
var u134 = document.getElementById('u134');
gv_vAlignTable['u134'] = 'top';
var u135 = document.getElementById('u135');
gv_vAlignTable['u135'] = 'top';
var u136 = document.getElementById('u136');

var u137 = document.getElementById('u137');

u137.style.cursor = 'pointer';
if (bIE) u137.attachEvent("onclick", Clicku137);
else u137.addEventListener("click", Clicku137, true);
function Clicku137(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u114','hidden','none',500);

	SetPanelVisibility('u99','','none',500);

	MoveWidgetBy('u139',0,-50,'swing',500);

}

}
gv_vAlignTable['u137'] = 'top';
var u138 = document.getElementById('u138');
gv_vAlignTable['u138'] = 'top';
var u139 = document.getElementById('u139');

var u140 = document.getElementById('u140');

var u141 = document.getElementById('u141');

var u142 = document.getElementById('u142');

var u143 = document.getElementById('u143');

var u144 = document.getElementById('u144');

if (bIE) u144.attachEvent("onblur", LostFocusu144);
else u144.addEventListener("blur", LostFocusu144, true);
function LostFocusu144(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u145', '' + (GetWidgetFormText('u142') * GetWidgetFormText('u144')) + '');

}

}

var u145 = document.getElementById('u145');

var u146 = document.getElementById('u146');
gv_vAlignTable['u146'] = 'top';
var u147 = document.getElementById('u147');
gv_vAlignTable['u147'] = 'top';
var u148 = document.getElementById('u148');
gv_vAlignTable['u148'] = 'top';
var u149 = document.getElementById('u149');
gv_vAlignTable['u149'] = 'top';
var u501 = document.getElementById('u501');

var u502 = document.getElementById('u502');

var u503 = document.getElementById('u503');

var u10 = document.getElementById('u10');
gv_vAlignTable['u10'] = 'top';
var u11 = document.getElementById('u11');

var u12 = document.getElementById('u12');

if (bIE) u12.attachEvent("onblur", LostFocusu12);
else u12.addEventListener("blur", LostFocusu12, true);
function LostFocusu12(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u13', '' + (GetWidgetFormText('u11') * GetWidgetFormText('u12')) + '');

SetWidgetFormText('u15', '' + (GetNum(GetWidgetFormText('u13')) + GetNum(GetWidgetFormText('u19'))) + '');

}

}

var u13 = document.getElementById('u13');

var u14 = document.getElementById('u14');
gv_vAlignTable['u14'] = 'top';
var u15 = document.getElementById('u15');

var u16 = document.getElementById('u16');

var u17 = document.getElementById('u17');

var u18 = document.getElementById('u18');

if (bIE) u18.attachEvent("onblur", LostFocusu18);
else u18.addEventListener("blur", LostFocusu18, true);
function LostFocusu18(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u19', '' + (GetWidgetFormText('u17') * GetWidgetFormText('u18')) + '');

}

}

var u19 = document.getElementById('u19');

var u150 = document.getElementById('u150');
gv_vAlignTable['u150'] = 'top';
var u151 = document.getElementById('u151');

var u152 = document.getElementById('u152');

u152.style.cursor = 'pointer';
if (bIE) u152.attachEvent("onclick", Clicku152);
else u152.addEventListener("click", Clicku152, true);
function Clicku152(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u140','hidden','none',500);

	SetPanelVisibility('u155','','fade',500);

}

}
gv_vAlignTable['u152'] = 'top';
var u153 = document.getElementById('u153');

u153.style.cursor = 'pointer';
if (bIE) u153.attachEvent("onclick", Clicku153);
else u153.addEventListener("click", Clicku153, true);
function Clicku153(e)
{
windowEvent = e;


if ((GetCheckState('u153')) == (true)) {

	SetPanelVisibility('u140','','fade',500);

}
else
if ((GetCheckState('u153')) == (false)) {

	SetPanelVisibility('u140','hidden','none',500);

	SetPanelVisibility('u155','hidden','none',500);

}

}

var u154 = document.getElementById('u154');
gv_vAlignTable['u154'] = 'top';
var u155 = document.getElementById('u155');

var u156 = document.getElementById('u156');

var u157 = document.getElementById('u157');

var u158 = document.getElementById('u158');

var u159 = document.getElementById('u159');

if (bIE) u159.attachEvent("onblur", LostFocusu159);
else u159.addEventListener("blur", LostFocusu159, true);
function LostFocusu159(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u160', '' + (GetWidgetFormText('u157') * GetWidgetFormText('u159')) + '');

}

}

var u511 = document.getElementById('u511');
gv_vAlignTable['u511'] = 'top';
var u512 = document.getElementById('u512');

var u513 = document.getElementById('u513');

var u20 = document.getElementById('u20');
gv_vAlignTable['u20'] = 'top';
var u21 = document.getElementById('u21');
gv_vAlignTable['u21'] = 'top';
var u22 = document.getElementById('u22');
gv_vAlignTable['u22'] = 'top';
var u23 = document.getElementById('u23');
gv_vAlignTable['u23'] = 'top';
var u24 = document.getElementById('u24');
gv_vAlignTable['u24'] = 'top';
var u25 = document.getElementById('u25');

var u26 = document.getElementById('u26');

var u27 = document.getElementById('u27');

var u28 = document.getElementById('u28');

u28.style.cursor = 'pointer';
if (bIE) u28.attachEvent("onclick", Clicku28);
else u28.addEventListener("click", Clicku28, true);
function Clicku28(e)
{
windowEvent = e;


if ((GetCheckState('u28')) == (true)) {

	MoveWidgetBy('u98',0,50,'swing',500);

	MoveWidgetBy('u139',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u28')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u98',0,-50,'swing',500);

	MoveWidgetBy('u139',0,-50,'swing',500);

}

}

var u29 = document.getElementById('u29');
gv_vAlignTable['u29'] = 'top';
var u160 = document.getElementById('u160');

var u161 = document.getElementById('u161');
gv_vAlignTable['u161'] = 'top';
var u162 = document.getElementById('u162');
gv_vAlignTable['u162'] = 'top';
var u163 = document.getElementById('u163');
gv_vAlignTable['u163'] = 'top';
var u164 = document.getElementById('u164');
gv_vAlignTable['u164'] = 'top';
var u165 = document.getElementById('u165');
gv_vAlignTable['u165'] = 'top';
var u166 = document.getElementById('u166');

var u167 = document.getElementById('u167');

var u168 = document.getElementById('u168');

var u169 = document.getElementById('u169');

var u521 = document.getElementById('u521');

var u522 = document.getElementById('u522');

if (bIE) u522.attachEvent("onblur", LostFocusu522);
else u522.addEventListener("blur", LostFocusu522, true);
function LostFocusu522(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u523', '' + (GetWidgetFormText('u521') * GetWidgetFormText('u522')) + '');

SetWidgetFormText('u525', '' + (GetNum(GetWidgetFormText('u523')) + GetNum(GetWidgetFormText('u529'))) + '');

}

}

var u203 = document.getElementById('u203');
gv_vAlignTable['u203'] = 'center';
var u30 = document.getElementById('u30');

var u31 = document.getElementById('u31');

var u206 = document.getElementById('u206');

if (bIE) u206.attachEvent("onblur", LostFocusu206);
else u206.addEventListener("blur", LostFocusu206, true);
function LostFocusu206(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u207', '' + (GetWidgetFormText('u205') * GetWidgetFormText('u206')) + '');

SetWidgetFormText('u209', '' + (GetNum(GetWidgetFormText('u207')) + GetNum(GetWidgetFormText('u213'))) + '');

}

}

var u207 = document.getElementById('u207');

var u208 = document.getElementById('u208');
gv_vAlignTable['u208'] = 'top';
var u209 = document.getElementById('u209');

var u36 = document.getElementById('u36');
gv_vAlignTable['u36'] = 'center';
var u37 = document.getElementById('u37');

var u38 = document.getElementById('u38');

var u39 = document.getElementById('u39');
gv_vAlignTable['u39'] = 'center';
var u170 = document.getElementById('u170');

if (bIE) u170.attachEvent("onblur", LostFocusu170);
else u170.addEventListener("blur", LostFocusu170, true);
function LostFocusu170(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u171', '' + (GetWidgetFormText('u168') * GetWidgetFormText('u170')) + '');

}

}

var u171 = document.getElementById('u171');

var u172 = document.getElementById('u172');
gv_vAlignTable['u172'] = 'top';
var u173 = document.getElementById('u173');
gv_vAlignTable['u173'] = 'top';
var u174 = document.getElementById('u174');
gv_vAlignTable['u174'] = 'top';
var u175 = document.getElementById('u175');
gv_vAlignTable['u175'] = 'top';
var u176 = document.getElementById('u176');
gv_vAlignTable['u176'] = 'top';
var u177 = document.getElementById('u177');

var u178 = document.getElementById('u178');

u178.style.cursor = 'pointer';
if (bIE) u178.attachEvent("onclick", Clicku178);
else u178.addEventListener("click", Clicku178, true);
function Clicku178(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u155','hidden','none',500);

	SetPanelVisibility('u140','','none',500);

}

}
gv_vAlignTable['u178'] = 'top';
var u179 = document.getElementById('u179');
gv_vAlignTable['u179'] = 'top';
var u531 = document.getElementById('u531');
gv_vAlignTable['u531'] = 'top';
var u532 = document.getElementById('u532');
gv_vAlignTable['u532'] = 'top';
var u533 = document.getElementById('u533');
gv_vAlignTable['u533'] = 'top';
var u40 = document.getElementById('u40');
gv_vAlignTable['u40'] = 'top';
var u41 = document.getElementById('u41');
gv_vAlignTable['u41'] = 'top';
var u42 = document.getElementById('u42');
gv_vAlignTable['u42'] = 'top';
var u43 = document.getElementById('u43');
gv_vAlignTable['u43'] = 'top';
var u44 = document.getElementById('u44');
gv_vAlignTable['u44'] = 'top';
var u45 = document.getElementById('u45');

var u46 = document.getElementById('u46');

var u47 = document.getElementById('u47');

var u48 = document.getElementById('u48');

var u49 = document.getElementById('u49');

if (bIE) u49.attachEvent("onblur", LostFocusu49);
else u49.addEventListener("blur", LostFocusu49, true);
function LostFocusu49(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u50', '' + (GetWidgetFormText('u47') * GetWidgetFormText('u49')) + '');

}

}

var u180 = document.getElementById('u180');

var u181 = document.getElementById('u181');

u181.style.cursor = 'pointer';
if (bIE) u181.attachEvent("onclick", Clicku181);
else u181.addEventListener("click", Clicku181, true);
function Clicku181(e)
{
windowEvent = e;


if (true) {

	self.location.href="passo-1-dados-projeto.html" + GetQuerystring();

}

}

var u182 = document.getElementById('u182');
gv_vAlignTable['u182'] = 'center';
var u183 = document.getElementById('u183');

u183.style.cursor = 'pointer';
if (bIE) u183.attachEvent("onclick", Clicku183);
else u183.addEventListener("click", Clicku183, true);
function Clicku183(e)
{
windowEvent = e;


if (true) {

	self.location.href="passo-2.2-dados-diretor.html" + GetQuerystring();

}

}

var u184 = document.getElementById('u184');
gv_vAlignTable['u184'] = 'center';
var u185 = document.getElementById('u185');

u185.style.cursor = 'pointer';
if (bIE) u185.attachEvent("onclick", Clicku185);
else u185.addEventListener("click", Clicku185, true);
function Clicku185(e)
{
windowEvent = e;


if (true) {

	self.location.href="passo-3.2-dados-produtor.html" + GetQuerystring();

}

}

var u186 = document.getElementById('u186');
gv_vAlignTable['u186'] = 'center';
var u187 = document.getElementById('u187');
gv_vAlignTable['u187'] = 'top';
var u188 = document.getElementById('u188');
gv_vAlignTable['u188'] = 'top';
var u189 = document.getElementById('u189');
gv_vAlignTable['u189'] = 'top';
var u541 = document.getElementById('u541');

var u542 = document.getElementById('u542');
gv_vAlignTable['u542'] = 'center';
var u543 = document.getElementById('u543');
gv_vAlignTable['u543'] = 'top';
var u50 = document.getElementById('u50');

var u51 = document.getElementById('u51');
gv_vAlignTable['u51'] = 'top';
var u52 = document.getElementById('u52');
gv_vAlignTable['u52'] = 'top';
var u53 = document.getElementById('u53');
gv_vAlignTable['u53'] = 'top';
var u54 = document.getElementById('u54');
gv_vAlignTable['u54'] = 'top';
var u55 = document.getElementById('u55');
gv_vAlignTable['u55'] = 'top';
var u56 = document.getElementById('u56');

var u57 = document.getElementById('u57');

u57.style.cursor = 'pointer';
if (bIE) u57.attachEvent("onclick", Clicku57);
else u57.addEventListener("click", Clicku57, true);
function Clicku57(e)
{
windowEvent = e;


if (true) {

	MoveWidgetBy('u98',0,60,'swing',500);

	MoveWidgetBy('u139',0,60,'swing',500);

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','','fade',500);

	BringToFront("u58");

}

}
gv_vAlignTable['u57'] = 'top';
var u58 = document.getElementById('u58');

var u59 = document.getElementById('u59');

u59.style.cursor = 'pointer';
if (bIE) u59.attachEvent("onclick", Clicku59);
else u59.addEventListener("click", Clicku59, true);
function Clicku59(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u58','hidden','none',500);

	SetPanelVisibility('u45','','none',500);

	BringToFront("u45");

	MoveWidgetBy('u98',0,-60,'swing',500);

	MoveWidgetBy('u139',0,-60,'swing',500);

}

}
gv_vAlignTable['u59'] = 'top';
var u190 = document.getElementById('u190');

var u191 = document.getElementById('u191');

var u192 = document.getElementById('u192');

var u193 = document.getElementById('u193');
gv_vAlignTable['u193'] = 'center';
var u194 = document.getElementById('u194');

var u195 = document.getElementById('u195');
gv_vAlignTable['u195'] = 'center';
var u196 = document.getElementById('u196');

u196.style.cursor = 'pointer';
if (bIE) u196.attachEvent("onclick", Clicku196);
else u196.addEventListener("click", Clicku196, true);
function Clicku196(e)
{
windowEvent = e;


if (true) {

	self.location.href="passo-5-envio-pj.html" + GetQuerystring();

}

}

var u197 = document.getElementById('u197');
gv_vAlignTable['u197'] = 'center';
var u198 = document.getElementById('u198');

u198.style.cursor = 'pointer';
if (bIE) u198.attachEvent("onclick", Clicku198);
else u198.addEventListener("click", Clicku198, true);
function Clicku198(e)
{
windowEvent = e;


if (true) {

	self.location.href="passo-3-portfolio-empresa.html" + GetQuerystring();

}

}

var u199 = document.getElementById('u199');
gv_vAlignTable['u199'] = 'center';
var u551 = document.getElementById('u551');
gv_vAlignTable['u551'] = 'center';
var u552 = document.getElementById('u552');

var u553 = document.getElementById('u553');
gv_vAlignTable['u553'] = 'center';
var u60 = document.getElementById('u60');

u60.style.cursor = 'pointer';
if (bIE) u60.attachEvent("onclick", Clicku60);
else u60.addEventListener("click", Clicku60, true);
function Clicku60(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u58','','none',500);

	SetPanelVisibility('u45','hidden','none',500);

	BringToFront("u58");

}

}
gv_vAlignTable['u60'] = 'top';
var u61 = document.getElementById('u61');

var u62 = document.getElementById('u62');

var u63 = document.getElementById('u63');

if (bIE) u63.attachEvent("onblur", LostFocusu63);
else u63.addEventListener("blur", LostFocusu63, true);
function LostFocusu63(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u64', '' + (GetWidgetFormText('u62') * GetWidgetFormText('u63')) + '');

SetWidgetFormText('u71', '' + (GetNum(GetWidgetFormText('u64')) + GetNum(GetWidgetFormText('u75'))) + '');

}

}

var u64 = document.getElementById('u64');

var u65 = document.getElementById('u65');
gv_vAlignTable['u65'] = 'top';
var u66 = document.getElementById('u66');
gv_vAlignTable['u66'] = 'top';
var u67 = document.getElementById('u67');
gv_vAlignTable['u67'] = 'top';
var u68 = document.getElementById('u68');
gv_vAlignTable['u68'] = 'top';
var u69 = document.getElementById('u69');
gv_vAlignTable['u69'] = 'top';
var u560 = document.getElementById('u560');
gv_vAlignTable['u560'] = 'top';
var u561 = document.getElementById('u561');
gv_vAlignTable['u561'] = 'top';
var u562 = document.getElementById('u562');
gv_vAlignTable['u562'] = 'top';
var u563 = document.getElementById('u563');
gv_vAlignTable['u563'] = 'top';
var u70 = document.getElementById('u70');
gv_vAlignTable['u70'] = 'top';
var u71 = document.getElementById('u71');

var u72 = document.getElementById('u72');

var u73 = document.getElementById('u73');

var u74 = document.getElementById('u74');

if (bIE) u74.attachEvent("onblur", LostFocusu74);
else u74.addEventListener("blur", LostFocusu74, true);
function LostFocusu74(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u75', '' + (GetWidgetFormText('u73') * GetWidgetFormText('u74')) + '');

}

}

var u75 = document.getElementById('u75');

var u76 = document.getElementById('u76');
gv_vAlignTable['u76'] = 'top';
var u77 = document.getElementById('u77');
gv_vAlignTable['u77'] = 'top';
var u78 = document.getElementById('u78');
gv_vAlignTable['u78'] = 'top';
var u79 = document.getElementById('u79');
gv_vAlignTable['u79'] = 'top';
var u80 = document.getElementById('u80');
gv_vAlignTable['u80'] = 'top';
var u81 = document.getElementById('u81');

var u82 = document.getElementById('u82');

var u83 = document.getElementById('u83');

var u84 = document.getElementById('u84');

var u85 = document.getElementById('u85');
gv_vAlignTable['u85'] = 'center';
var u86 = document.getElementById('u86');

var u87 = document.getElementById('u87');
gv_vAlignTable['u87'] = 'center';
var u88 = document.getElementById('u88');
gv_vAlignTable['u88'] = 'top';
var u89 = document.getElementById('u89');
gv_vAlignTable['u89'] = 'top';
var u90 = document.getElementById('u90');
gv_vAlignTable['u90'] = 'top';
var u91 = document.getElementById('u91');

var u92 = document.getElementById('u92');

var u93 = document.getElementById('u93');

u93.style.cursor = 'pointer';
if (bIE) u93.attachEvent("onclick", Clicku93);
else u93.addEventListener("click", Clicku93, true);
function Clicku93(e)
{
windowEvent = e;


if ((GetCheckState('u93')) == (true)) {

	MoveWidgetBy('u98',0,50,'swing',500);

	MoveWidgetBy('u139',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u93')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u98',0,-50,'swing',500);

	MoveWidgetBy('u139',0,-50,'swing',500);

}

}

var u94 = document.getElementById('u94');
gv_vAlignTable['u94'] = 'top';
var u95 = document.getElementById('u95');

var u96 = document.getElementById('u96');
gv_vAlignTable['u96'] = 'top';
var u97 = document.getElementById('u97');

var u98 = document.getElementById('u98');

var u99 = document.getElementById('u99');

var u400 = document.getElementById('u400');
gv_vAlignTable['u400'] = 'top';
var u401 = document.getElementById('u401');
gv_vAlignTable['u401'] = 'top';
var u402 = document.getElementById('u402');
gv_vAlignTable['u402'] = 'top';
var u403 = document.getElementById('u403');
gv_vAlignTable['u403'] = 'top';
var u404 = document.getElementById('u404');

var u405 = document.getElementById('u405');

if (bIE) u405.attachEvent("onblur", LostFocusu405);
else u405.addEventListener("blur", LostFocusu405, true);
function LostFocusu405(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u406', '' + (GetWidgetFormText('u404') * GetWidgetFormText('u405')) + '');

SetWidgetFormText('u408', '' + (GetNum(GetWidgetFormText('u406')) + GetNum(GetWidgetFormText('u412'))) + '');

}

}

var u406 = document.getElementById('u406');

var u407 = document.getElementById('u407');
gv_vAlignTable['u407'] = 'top';
var u408 = document.getElementById('u408');

var u409 = document.getElementById('u409');

var u410 = document.getElementById('u410');

var u411 = document.getElementById('u411');

if (bIE) u411.attachEvent("onblur", LostFocusu411);
else u411.addEventListener("blur", LostFocusu411, true);
function LostFocusu411(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u412', '' + (GetWidgetFormText('u410') * GetWidgetFormText('u411')) + '');

}

}

var u412 = document.getElementById('u412');

var u413 = document.getElementById('u413');
gv_vAlignTable['u413'] = 'top';
var u414 = document.getElementById('u414');
gv_vAlignTable['u414'] = 'top';
var u415 = document.getElementById('u415');
gv_vAlignTable['u415'] = 'top';
var u416 = document.getElementById('u416');
gv_vAlignTable['u416'] = 'top';
var u417 = document.getElementById('u417');
gv_vAlignTable['u417'] = 'top';
var u418 = document.getElementById('u418');

var u419 = document.getElementById('u419');

var u420 = document.getElementById('u420');

var u421 = document.getElementById('u421');

u421.style.cursor = 'pointer';
if (bIE) u421.attachEvent("onclick", Clicku421);
else u421.addEventListener("click", Clicku421, true);
function Clicku421(e)
{
windowEvent = e;


if ((GetCheckState('u421')) == (true)) {

	MoveWidgetBy('u98',0,50,'swing',500);

	MoveWidgetBy('u139',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u421')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u98',0,-50,'swing',500);

	MoveWidgetBy('u139',0,-50,'swing',500);

}

}

var u422 = document.getElementById('u422');
gv_vAlignTable['u422'] = 'top';
var u423 = document.getElementById('u423');

var u424 = document.getElementById('u424');

var u425 = document.getElementById('u425');
gv_vAlignTable['u425'] = 'center';
var u426 = document.getElementById('u426');
gv_vAlignTable['u426'] = 'top';
var u427 = document.getElementById('u427');

var u428 = document.getElementById('u428');
gv_vAlignTable['u428'] = 'center';
var u429 = document.getElementById('u429');

var u290 = document.getElementById('u290');
gv_vAlignTable['u290'] = 'top';
var u291 = document.getElementById('u291');
gv_vAlignTable['u291'] = 'top';
var u292 = document.getElementById('u292');
gv_vAlignTable['u292'] = 'top';
var u293 = document.getElementById('u293');
gv_vAlignTable['u293'] = 'top';
var u294 = document.getElementById('u294');
gv_vAlignTable['u294'] = 'top';
var u295 = document.getElementById('u295');

var u296 = document.getElementById('u296');

if (bIE) u296.attachEvent("onblur", LostFocusu296);
else u296.addEventListener("blur", LostFocusu296, true);
function LostFocusu296(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u297', '' + (GetWidgetFormText('u295') * GetWidgetFormText('u296')) + '');

SetWidgetFormText('u299', '' + (GetNum(GetWidgetFormText('u297')) + GetNum(GetWidgetFormText('u303'))) + '');

}

}

var u430 = document.getElementById('u430');
gv_vAlignTable['u430'] = 'center';
var u431 = document.getElementById('u431');

var u432 = document.getElementById('u432');

var u433 = document.getElementById('u433');
gv_vAlignTable['u433'] = 'center';
var u434 = document.getElementById('u434');
gv_vAlignTable['u434'] = 'top';
var u435 = document.getElementById('u435');
gv_vAlignTable['u435'] = 'top';
var u436 = document.getElementById('u436');
gv_vAlignTable['u436'] = 'top';
var u437 = document.getElementById('u437');
gv_vAlignTable['u437'] = 'top';
var u438 = document.getElementById('u438');
gv_vAlignTable['u438'] = 'top';
var u439 = document.getElementById('u439');

var u440 = document.getElementById('u440');

if (bIE) u440.attachEvent("onblur", LostFocusu440);
else u440.addEventListener("blur", LostFocusu440, true);
function LostFocusu440(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u441', '' + (GetWidgetFormText('u439') * GetWidgetFormText('u440')) + '');

SetWidgetFormText('u443', '' + (GetNum(GetWidgetFormText('u441')) + GetNum(GetWidgetFormText('u447'))) + '');

}

}

var u441 = document.getElementById('u441');

var u442 = document.getElementById('u442');
gv_vAlignTable['u442'] = 'top';
var u443 = document.getElementById('u443');

var u444 = document.getElementById('u444');

var u445 = document.getElementById('u445');

var u446 = document.getElementById('u446');

if (bIE) u446.attachEvent("onblur", LostFocusu446);
else u446.addEventListener("blur", LostFocusu446, true);
function LostFocusu446(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u447', '' + (GetWidgetFormText('u445') * GetWidgetFormText('u446')) + '');

}

}

var u447 = document.getElementById('u447');

var u448 = document.getElementById('u448');
gv_vAlignTable['u448'] = 'top';
var u449 = document.getElementById('u449');
gv_vAlignTable['u449'] = 'top';
var u450 = document.getElementById('u450');
gv_vAlignTable['u450'] = 'top';
var u451 = document.getElementById('u451');
gv_vAlignTable['u451'] = 'top';
var u452 = document.getElementById('u452');
gv_vAlignTable['u452'] = 'top';
var u453 = document.getElementById('u453');

var u454 = document.getElementById('u454');

var u455 = document.getElementById('u455');

var u456 = document.getElementById('u456');

u456.style.cursor = 'pointer';
if (bIE) u456.attachEvent("onclick", Clicku456);
else u456.addEventListener("click", Clicku456, true);
function Clicku456(e)
{
windowEvent = e;


if ((GetCheckState('u456')) == (true)) {

	MoveWidgetBy('u98',0,50,'swing',500);

	MoveWidgetBy('u139',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u456')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u98',0,-50,'swing',500);

	MoveWidgetBy('u139',0,-50,'swing',500);

}

}

var u457 = document.getElementById('u457');
gv_vAlignTable['u457'] = 'top';
var u458 = document.getElementById('u458');
gv_vAlignTable['u458'] = 'top';
var u459 = document.getElementById('u459');
gv_vAlignTable['u459'] = 'top';
var u460 = document.getElementById('u460');
gv_vAlignTable['u460'] = 'top';
var u461 = document.getElementById('u461');
gv_vAlignTable['u461'] = 'top';
var u462 = document.getElementById('u462');
gv_vAlignTable['u462'] = 'top';
var u463 = document.getElementById('u463');

var u464 = document.getElementById('u464');

if (bIE) u464.attachEvent("onblur", LostFocusu464);
else u464.addEventListener("blur", LostFocusu464, true);
function LostFocusu464(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u465', '' + (GetWidgetFormText('u463') * GetWidgetFormText('u464')) + '');

SetWidgetFormText('u467', '' + (GetNum(GetWidgetFormText('u465')) + GetNum(GetWidgetFormText('u471'))) + '');

}

}

var u465 = document.getElementById('u465');

var u466 = document.getElementById('u466');
gv_vAlignTable['u466'] = 'top';
var u467 = document.getElementById('u467');

var u468 = document.getElementById('u468');

var u469 = document.getElementById('u469');

var u470 = document.getElementById('u470');

if (bIE) u470.attachEvent("onblur", LostFocusu470);
else u470.addEventListener("blur", LostFocusu470, true);
function LostFocusu470(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u471', '' + (GetWidgetFormText('u469') * GetWidgetFormText('u470')) + '');

}

}

var u471 = document.getElementById('u471');

var u472 = document.getElementById('u472');
gv_vAlignTable['u472'] = 'top';
var u473 = document.getElementById('u473');
gv_vAlignTable['u473'] = 'top';
var u474 = document.getElementById('u474');
gv_vAlignTable['u474'] = 'top';
var u475 = document.getElementById('u475');
gv_vAlignTable['u475'] = 'top';
var u476 = document.getElementById('u476');
gv_vAlignTable['u476'] = 'top';
var u477 = document.getElementById('u477');

var u478 = document.getElementById('u478');

var u479 = document.getElementById('u479');

var u480 = document.getElementById('u480');

u480.style.cursor = 'pointer';
if (bIE) u480.attachEvent("onclick", Clicku480);
else u480.addEventListener("click", Clicku480, true);
function Clicku480(e)
{
windowEvent = e;


if ((GetCheckState('u480')) == (true)) {

	MoveWidgetBy('u98',0,50,'swing',500);

	MoveWidgetBy('u139',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u480')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u98',0,-50,'swing',500);

	MoveWidgetBy('u139',0,-50,'swing',500);

}

}

var u481 = document.getElementById('u481');
gv_vAlignTable['u481'] = 'top';
var u482 = document.getElementById('u482');
gv_vAlignTable['u482'] = 'top';
var u483 = document.getElementById('u483');
gv_vAlignTable['u483'] = 'top';
var u484 = document.getElementById('u484');
gv_vAlignTable['u484'] = 'top';
var u485 = document.getElementById('u485');
gv_vAlignTable['u485'] = 'top';
var u486 = document.getElementById('u486');
gv_vAlignTable['u486'] = 'top';
var u487 = document.getElementById('u487');

var u488 = document.getElementById('u488');

if (bIE) u488.attachEvent("onblur", LostFocusu488);
else u488.addEventListener("blur", LostFocusu488, true);
function LostFocusu488(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u489', '' + (GetWidgetFormText('u487') * GetWidgetFormText('u488')) + '');

SetWidgetFormText('u491', '' + (GetNum(GetWidgetFormText('u489')) + GetNum(GetWidgetFormText('u495'))) + '');

}

}

var u489 = document.getElementById('u489');

var u204 = document.getElementById('u204');
gv_vAlignTable['u204'] = 'top';
var u300 = document.getElementById('u300');

var u301 = document.getElementById('u301');

var u302 = document.getElementById('u302');

if (bIE) u302.attachEvent("onblur", LostFocusu302);
else u302.addEventListener("blur", LostFocusu302, true);
function LostFocusu302(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u303', '' + (GetWidgetFormText('u301') * GetWidgetFormText('u302')) + '');

}

}

var u303 = document.getElementById('u303');

var u304 = document.getElementById('u304');
gv_vAlignTable['u304'] = 'top';
var u305 = document.getElementById('u305');
gv_vAlignTable['u305'] = 'top';
var u306 = document.getElementById('u306');
gv_vAlignTable['u306'] = 'top';
var u307 = document.getElementById('u307');
gv_vAlignTable['u307'] = 'top';
var u308 = document.getElementById('u308');
gv_vAlignTable['u308'] = 'top';
var u309 = document.getElementById('u309');

var u497 = document.getElementById('u497');
gv_vAlignTable['u497'] = 'top';
var u498 = document.getElementById('u498');
gv_vAlignTable['u498'] = 'top';
var u499 = document.getElementById('u499');
gv_vAlignTable['u499'] = 'top';
var u504 = document.getElementById('u504');

u504.style.cursor = 'pointer';
if (bIE) u504.attachEvent("onclick", Clicku504);
else u504.addEventListener("click", Clicku504, true);
function Clicku504(e)
{
windowEvent = e;


if ((GetCheckState('u504')) == (true)) {

	MoveWidgetBy('u98',0,50,'swing',500);

	MoveWidgetBy('u139',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u504')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u98',0,-50,'swing',500);

	MoveWidgetBy('u139',0,-50,'swing',500);

}

}

var u505 = document.getElementById('u505');
gv_vAlignTable['u505'] = 'top';
var u506 = document.getElementById('u506');

var u507 = document.getElementById('u507');

var u508 = document.getElementById('u508');
gv_vAlignTable['u508'] = 'center';
var u509 = document.getElementById('u509');
gv_vAlignTable['u509'] = 'top';
var u310 = document.getElementById('u310');

var u311 = document.getElementById('u311');

var u312 = document.getElementById('u312');

u312.style.cursor = 'pointer';
if (bIE) u312.attachEvent("onclick", Clicku312);
else u312.addEventListener("click", Clicku312, true);
function Clicku312(e)
{
windowEvent = e;


if ((GetCheckState('u312')) == (true)) {

	MoveWidgetBy('u98',0,50,'swing',500);

	MoveWidgetBy('u139',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u312')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u98',0,-50,'swing',500);

	MoveWidgetBy('u139',0,-50,'swing',500);

}

}

var u313 = document.getElementById('u313');
gv_vAlignTable['u313'] = 'top';
var u314 = document.getElementById('u314');
gv_vAlignTable['u314'] = 'top';
var u315 = document.getElementById('u315');
gv_vAlignTable['u315'] = 'top';
var u316 = document.getElementById('u316');
gv_vAlignTable['u316'] = 'top';
var u317 = document.getElementById('u317');
gv_vAlignTable['u317'] = 'top';
var u318 = document.getElementById('u318');
gv_vAlignTable['u318'] = 'top';
var u319 = document.getElementById('u319');

var u514 = document.getElementById('u514');

var u515 = document.getElementById('u515');
gv_vAlignTable['u515'] = 'center';
var u516 = document.getElementById('u516');
gv_vAlignTable['u516'] = 'top';
var u517 = document.getElementById('u517');
gv_vAlignTable['u517'] = 'top';
var u518 = document.getElementById('u518');
gv_vAlignTable['u518'] = 'top';
var u519 = document.getElementById('u519');
gv_vAlignTable['u519'] = 'top';
var u320 = document.getElementById('u320');

if (bIE) u320.attachEvent("onblur", LostFocusu320);
else u320.addEventListener("blur", LostFocusu320, true);
function LostFocusu320(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u321', '' + (GetWidgetFormText('u319') * GetWidgetFormText('u320')) + '');

SetWidgetFormText('u323', '' + (GetNum(GetWidgetFormText('u321')) + GetNum(GetWidgetFormText('u327'))) + '');

}

}

var u321 = document.getElementById('u321');

var u322 = document.getElementById('u322');
gv_vAlignTable['u322'] = 'top';
var u323 = document.getElementById('u323');

var u324 = document.getElementById('u324');

var u325 = document.getElementById('u325');

var u326 = document.getElementById('u326');

if (bIE) u326.attachEvent("onblur", LostFocusu326);
else u326.addEventListener("blur", LostFocusu326, true);
function LostFocusu326(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u327', '' + (GetWidgetFormText('u325') * GetWidgetFormText('u326')) + '');

}

}

var u327 = document.getElementById('u327');

var u328 = document.getElementById('u328');
gv_vAlignTable['u328'] = 'top';
var u329 = document.getElementById('u329');
gv_vAlignTable['u329'] = 'top';
var u520 = document.getElementById('u520');
gv_vAlignTable['u520'] = 'top';
var u523 = document.getElementById('u523');

var u524 = document.getElementById('u524');
gv_vAlignTable['u524'] = 'top';
var u525 = document.getElementById('u525');

var u526 = document.getElementById('u526');

var u527 = document.getElementById('u527');

var u528 = document.getElementById('u528');

if (bIE) u528.attachEvent("onblur", LostFocusu528);
else u528.addEventListener("blur", LostFocusu528, true);
function LostFocusu528(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u529', '' + (GetWidgetFormText('u527') * GetWidgetFormText('u528')) + '');

}

}

var u529 = document.getElementById('u529');

var u330 = document.getElementById('u330');
gv_vAlignTable['u330'] = 'top';
var u331 = document.getElementById('u331');
gv_vAlignTable['u331'] = 'top';
var u332 = document.getElementById('u332');
gv_vAlignTable['u332'] = 'top';
var u333 = document.getElementById('u333');

var u334 = document.getElementById('u334');

var u335 = document.getElementById('u335');

var u336 = document.getElementById('u336');

u336.style.cursor = 'pointer';
if (bIE) u336.attachEvent("onclick", Clicku336);
else u336.addEventListener("click", Clicku336, true);
function Clicku336(e)
{
windowEvent = e;


if ((GetCheckState('u336')) == (true)) {

	MoveWidgetBy('u98',0,50,'swing',500);

	MoveWidgetBy('u139',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u336')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u98',0,-50,'swing',500);

	MoveWidgetBy('u139',0,-50,'swing',500);

}

}

var u337 = document.getElementById('u337');
gv_vAlignTable['u337'] = 'top';
var u338 = document.getElementById('u338');
gv_vAlignTable['u338'] = 'top';
var u339 = document.getElementById('u339');
gv_vAlignTable['u339'] = 'top';
var u530 = document.getElementById('u530');
gv_vAlignTable['u530'] = 'top';
var u534 = document.getElementById('u534');
gv_vAlignTable['u534'] = 'top';
var u535 = document.getElementById('u535');

var u536 = document.getElementById('u536');

var u537 = document.getElementById('u537');

var u538 = document.getElementById('u538');

u538.style.cursor = 'pointer';
if (bIE) u538.attachEvent("onclick", Clicku538);
else u538.addEventListener("click", Clicku538, true);
function Clicku538(e)
{
windowEvent = e;


if ((GetCheckState('u538')) == (true)) {

	MoveWidgetBy('u98',0,50,'swing',500);

	MoveWidgetBy('u139',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u538')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u98',0,-50,'swing',500);

	MoveWidgetBy('u139',0,-50,'swing',500);

}

}

var u539 = document.getElementById('u539');
gv_vAlignTable['u539'] = 'top';
var u340 = document.getElementById('u340');
gv_vAlignTable['u340'] = 'top';
var u341 = document.getElementById('u341');
gv_vAlignTable['u341'] = 'top';
var u342 = document.getElementById('u342');
gv_vAlignTable['u342'] = 'top';
var u343 = document.getElementById('u343');

var u344 = document.getElementById('u344');

if (bIE) u344.attachEvent("onblur", LostFocusu344);
else u344.addEventListener("blur", LostFocusu344, true);
function LostFocusu344(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u345', '' + (GetWidgetFormText('u343') * GetWidgetFormText('u344')) + '');

SetWidgetFormText('u347', '' + (GetNum(GetWidgetFormText('u345')) + GetNum(GetWidgetFormText('u351'))) + '');

}

}

var u345 = document.getElementById('u345');

var u346 = document.getElementById('u346');
gv_vAlignTable['u346'] = 'top';
var u347 = document.getElementById('u347');

var u348 = document.getElementById('u348');

var u349 = document.getElementById('u349');

var u540 = document.getElementById('u540');

var u544 = document.getElementById('u544');
gv_vAlignTable['u544'] = 'top';
var u545 = document.getElementById('u545');

var u546 = document.getElementById('u546');
gv_vAlignTable['u546'] = 'top';
var u547 = document.getElementById('u547');

var u548 = document.getElementById('u548');

var u549 = document.getElementById('u549');
gv_vAlignTable['u549'] = 'center';
var u350 = document.getElementById('u350');

if (bIE) u350.attachEvent("onblur", LostFocusu350);
else u350.addEventListener("blur", LostFocusu350, true);
function LostFocusu350(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u351', '' + (GetWidgetFormText('u349') * GetWidgetFormText('u350')) + '');

}

}

var u351 = document.getElementById('u351');

var u352 = document.getElementById('u352');
gv_vAlignTable['u352'] = 'top';
var u353 = document.getElementById('u353');
gv_vAlignTable['u353'] = 'top';
var u354 = document.getElementById('u354');
gv_vAlignTable['u354'] = 'top';
var u355 = document.getElementById('u355');
gv_vAlignTable['u355'] = 'top';
var u356 = document.getElementById('u356');
gv_vAlignTable['u356'] = 'top';
var u357 = document.getElementById('u357');

var u358 = document.getElementById('u358');

var u359 = document.getElementById('u359');

var u550 = document.getElementById('u550');

var u554 = document.getElementById('u554');

var u555 = document.getElementById('u555');
gv_vAlignTable['u555'] = 'center';
var u556 = document.getElementById('u556');

var u557 = document.getElementById('u557');
gv_vAlignTable['u557'] = 'center';
var u558 = document.getElementById('u558');
gv_vAlignTable['u558'] = 'top';
var u559 = document.getElementById('u559');
gv_vAlignTable['u559'] = 'top';
var u360 = document.getElementById('u360');

u360.style.cursor = 'pointer';
if (bIE) u360.attachEvent("onclick", Clicku360);
else u360.addEventListener("click", Clicku360, true);
function Clicku360(e)
{
windowEvent = e;


if ((GetCheckState('u360')) == (true)) {

	MoveWidgetBy('u98',0,50,'swing',500);

	MoveWidgetBy('u139',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u360')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u98',0,-50,'swing',500);

	MoveWidgetBy('u139',0,-50,'swing',500);

}

}

var u361 = document.getElementById('u361');
gv_vAlignTable['u361'] = 'top';
var u362 = document.getElementById('u362');

var u363 = document.getElementById('u363');

var u364 = document.getElementById('u364');
gv_vAlignTable['u364'] = 'center';
var u365 = document.getElementById('u365');
gv_vAlignTable['u365'] = 'top';
var u366 = document.getElementById('u366');
gv_vAlignTable['u366'] = 'top';
var u367 = document.getElementById('u367');
gv_vAlignTable['u367'] = 'top';
var u368 = document.getElementById('u368');

var u369 = document.getElementById('u369');

var u564 = document.getElementById('u564');
gv_vAlignTable['u564'] = 'top';
var u565 = document.getElementById('u565');
gv_vAlignTable['u565'] = 'top';
var u566 = document.getElementById('u566');

var u567 = document.getElementById('u567');
gv_vAlignTable['u567'] = 'top';
var u568 = document.getElementById('u568');

var u370 = document.getElementById('u370');

var u371 = document.getElementById('u371');
gv_vAlignTable['u371'] = 'center';
var u372 = document.getElementById('u372');
gv_vAlignTable['u372'] = 'top';
var u373 = document.getElementById('u373');
gv_vAlignTable['u373'] = 'top';
var u374 = document.getElementById('u374');
gv_vAlignTable['u374'] = 'top';
var u375 = document.getElementById('u375');
gv_vAlignTable['u375'] = 'top';
var u376 = document.getElementById('u376');
gv_vAlignTable['u376'] = 'top';
var u377 = document.getElementById('u377');

var u378 = document.getElementById('u378');

if (bIE) u378.attachEvent("onblur", LostFocusu378);
else u378.addEventListener("blur", LostFocusu378, true);
function LostFocusu378(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u379', '' + (GetWidgetFormText('u377') * GetWidgetFormText('u378')) + '');

SetWidgetFormText('u381', '' + (GetNum(GetWidgetFormText('u379')) + GetNum(GetWidgetFormText('u385'))) + '');

}

}

var u379 = document.getElementById('u379');

var u380 = document.getElementById('u380');
gv_vAlignTable['u380'] = 'top';
var u381 = document.getElementById('u381');

var u382 = document.getElementById('u382');

var u383 = document.getElementById('u383');

var u384 = document.getElementById('u384');

if (bIE) u384.attachEvent("onblur", LostFocusu384);
else u384.addEventListener("blur", LostFocusu384, true);
function LostFocusu384(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u385', '' + (GetWidgetFormText('u383') * GetWidgetFormText('u384')) + '');

}

}

var u385 = document.getElementById('u385');

var u386 = document.getElementById('u386');
gv_vAlignTable['u386'] = 'top';
var u387 = document.getElementById('u387');
gv_vAlignTable['u387'] = 'top';
var u388 = document.getElementById('u388');
gv_vAlignTable['u388'] = 'top';
var u389 = document.getElementById('u389');
gv_vAlignTable['u389'] = 'top';
var u200 = document.getElementById('u200');

var u201 = document.getElementById('u201');
gv_vAlignTable['u201'] = 'center';
var u202 = document.getElementById('u202');

var u390 = document.getElementById('u390');
gv_vAlignTable['u390'] = 'top';
var u391 = document.getElementById('u391');

var u205 = document.getElementById('u205');

var u393 = document.getElementById('u393');

var u394 = document.getElementById('u394');

u394.style.cursor = 'pointer';
if (bIE) u394.attachEvent("onclick", Clicku394);
else u394.addEventListener("click", Clicku394, true);
function Clicku394(e)
{
windowEvent = e;


if ((GetCheckState('u394')) == (true)) {

	MoveWidgetBy('u98',0,50,'swing',500);

	MoveWidgetBy('u139',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u394')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u98',0,-50,'swing',500);

	MoveWidgetBy('u139',0,-50,'swing',500);

}

}

var u395 = document.getElementById('u395');
gv_vAlignTable['u395'] = 'top';
var u396 = document.getElementById('u396');

var u397 = document.getElementById('u397');

var u398 = document.getElementById('u398');
gv_vAlignTable['u398'] = 'center';
var u399 = document.getElementById('u399');
gv_vAlignTable['u399'] = 'top';
var u210 = document.getElementById('u210');

var u211 = document.getElementById('u211');

var u212 = document.getElementById('u212');

if (bIE) u212.attachEvent("onblur", LostFocusu212);
else u212.addEventListener("blur", LostFocusu212, true);
function LostFocusu212(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u213', '' + (GetWidgetFormText('u211') * GetWidgetFormText('u212')) + '');

}

}

var u213 = document.getElementById('u213');

var u214 = document.getElementById('u214');
gv_vAlignTable['u214'] = 'top';
var u215 = document.getElementById('u215');
gv_vAlignTable['u215'] = 'top';
var u216 = document.getElementById('u216');
gv_vAlignTable['u216'] = 'top';
var u217 = document.getElementById('u217');
gv_vAlignTable['u217'] = 'top';
var u218 = document.getElementById('u218');
gv_vAlignTable['u218'] = 'top';
var u219 = document.getElementById('u219');

var u220 = document.getElementById('u220');

var u221 = document.getElementById('u221');

var u222 = document.getElementById('u222');

u222.style.cursor = 'pointer';
if (bIE) u222.attachEvent("onclick", Clicku222);
else u222.addEventListener("click", Clicku222, true);
function Clicku222(e)
{
windowEvent = e;


if ((GetCheckState('u222')) == (true)) {

	MoveWidgetBy('u98',0,50,'swing',500);

	MoveWidgetBy('u139',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u222')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u98',0,-50,'swing',500);

	MoveWidgetBy('u139',0,-50,'swing',500);

}

}

var u223 = document.getElementById('u223');
gv_vAlignTable['u223'] = 'top';
var u224 = document.getElementById('u224');
gv_vAlignTable['u224'] = 'top';
var u225 = document.getElementById('u225');
gv_vAlignTable['u225'] = 'top';
var u226 = document.getElementById('u226');
gv_vAlignTable['u226'] = 'top';
var u227 = document.getElementById('u227');
gv_vAlignTable['u227'] = 'top';
var u228 = document.getElementById('u228');
gv_vAlignTable['u228'] = 'top';
var u229 = document.getElementById('u229');

var u230 = document.getElementById('u230');

if (bIE) u230.attachEvent("onblur", LostFocusu230);
else u230.addEventListener("blur", LostFocusu230, true);
function LostFocusu230(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u231', '' + (GetWidgetFormText('u229') * GetWidgetFormText('u230')) + '');

SetWidgetFormText('u233', '' + (GetNum(GetWidgetFormText('u231')) + GetNum(GetWidgetFormText('u237'))) + '');

}

}

var u231 = document.getElementById('u231');

var u232 = document.getElementById('u232');
gv_vAlignTable['u232'] = 'top';
var u233 = document.getElementById('u233');

var u234 = document.getElementById('u234');

var u235 = document.getElementById('u235');

var u236 = document.getElementById('u236');

if (bIE) u236.attachEvent("onblur", LostFocusu236);
else u236.addEventListener("blur", LostFocusu236, true);
function LostFocusu236(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u237', '' + (GetWidgetFormText('u235') * GetWidgetFormText('u236')) + '');

}

}

var u237 = document.getElementById('u237');

var u238 = document.getElementById('u238');
gv_vAlignTable['u238'] = 'top';
var u239 = document.getElementById('u239');
gv_vAlignTable['u239'] = 'top';
var u240 = document.getElementById('u240');
gv_vAlignTable['u240'] = 'top';
var u241 = document.getElementById('u241');
gv_vAlignTable['u241'] = 'top';
var u242 = document.getElementById('u242');
gv_vAlignTable['u242'] = 'top';
var u243 = document.getElementById('u243');

var u244 = document.getElementById('u244');

var u245 = document.getElementById('u245');

var u246 = document.getElementById('u246');

u246.style.cursor = 'pointer';
if (bIE) u246.attachEvent("onclick", Clicku246);
else u246.addEventListener("click", Clicku246, true);
function Clicku246(e)
{
windowEvent = e;


if ((GetCheckState('u246')) == (true)) {

	MoveWidgetBy('u98',0,50,'swing',500);

	MoveWidgetBy('u139',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u246')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u98',0,-50,'swing',500);

	MoveWidgetBy('u139',0,-50,'swing',500);

}

}

var u247 = document.getElementById('u247');
gv_vAlignTable['u247'] = 'top';
var u248 = document.getElementById('u248');
gv_vAlignTable['u248'] = 'top';
var u249 = document.getElementById('u249');
gv_vAlignTable['u249'] = 'top';
var u250 = document.getElementById('u250');
gv_vAlignTable['u250'] = 'top';
var u251 = document.getElementById('u251');
gv_vAlignTable['u251'] = 'top';
var u252 = document.getElementById('u252');
gv_vAlignTable['u252'] = 'top';
var u253 = document.getElementById('u253');

var u254 = document.getElementById('u254');

if (bIE) u254.attachEvent("onblur", LostFocusu254);
else u254.addEventListener("blur", LostFocusu254, true);
function LostFocusu254(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u255', '' + (GetWidgetFormText('u253') * GetWidgetFormText('u254')) + '');

SetWidgetFormText('u257', '' + (GetNum(GetWidgetFormText('u255')) + GetNum(GetWidgetFormText('u261'))) + '');

}

}

var u255 = document.getElementById('u255');

var u256 = document.getElementById('u256');
gv_vAlignTable['u256'] = 'top';
var u257 = document.getElementById('u257');

var u258 = document.getElementById('u258');

var u259 = document.getElementById('u259');

var u0 = document.getElementById('u0');

var u1 = document.getElementById('u1');
gv_vAlignTable['u1'] = 'center';
var u2 = document.getElementById('u2');

var u3 = document.getElementById('u3');
gv_vAlignTable['u3'] = 'center';
var u4 = document.getElementById('u4');

var u5 = document.getElementById('u5');
gv_vAlignTable['u5'] = 'center';
var u6 = document.getElementById('u6');
gv_vAlignTable['u6'] = 'top';
var u7 = document.getElementById('u7');
gv_vAlignTable['u7'] = 'top';
var u8 = document.getElementById('u8');
gv_vAlignTable['u8'] = 'top';
var u260 = document.getElementById('u260');

if (bIE) u260.attachEvent("onblur", LostFocusu260);
else u260.addEventListener("blur", LostFocusu260, true);
function LostFocusu260(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u261', '' + (GetWidgetFormText('u259') * GetWidgetFormText('u260')) + '');

}

}

var u261 = document.getElementById('u261');

var u262 = document.getElementById('u262');
gv_vAlignTable['u262'] = 'top';
var u263 = document.getElementById('u263');
gv_vAlignTable['u263'] = 'top';
var u264 = document.getElementById('u264');
gv_vAlignTable['u264'] = 'top';
var u265 = document.getElementById('u265');
gv_vAlignTable['u265'] = 'top';
var u266 = document.getElementById('u266');
gv_vAlignTable['u266'] = 'top';
var u267 = document.getElementById('u267');

var u268 = document.getElementById('u268');

var u269 = document.getElementById('u269');

if (window.OnLoad) OnLoad();
