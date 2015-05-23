
var PageName = 'cm-passo-4-orcamento';
var PageId = '8fc1c1b0c7664979abff2e52e5938f33'
var PageUrl = 'cm-passo-4-orcamento.html'
document.title = 'cm-passo-4-orcamento';
var PageNotes = 
{
"pageName":"cm-passo-4-orcamento",
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
  value = value.replace(/\[\[GenDay\]\]/g, '23');
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

var u271 = document.getElementById('u271');

var u272 = document.getElementById('u272');
gv_vAlignTable['u272'] = 'center';
var u273 = document.getElementById('u273');
gv_vAlignTable['u273'] = 'top';
var u274 = document.getElementById('u274');
gv_vAlignTable['u274'] = 'top';
var u275 = document.getElementById('u275');
gv_vAlignTable['u275'] = 'top';
var u276 = document.getElementById('u276');

var u277 = document.getElementById('u277');

var u278 = document.getElementById('u278');
gv_vAlignTable['u278'] = 'center';
var u279 = document.getElementById('u279');
gv_vAlignTable['u279'] = 'top';
var u280 = document.getElementById('u280');

var u281 = document.getElementById('u281');

var u282 = document.getElementById('u282');
gv_vAlignTable['u282'] = 'center';
var u283 = document.getElementById('u283');

var u284 = document.getElementById('u284');
gv_vAlignTable['u284'] = 'center';
var u285 = document.getElementById('u285');

var u286 = document.getElementById('u286');

var u287 = document.getElementById('u287');
gv_vAlignTable['u287'] = 'center';
var u288 = document.getElementById('u288');
gv_vAlignTable['u288'] = 'top';
var u289 = document.getElementById('u289');
gv_vAlignTable['u289'] = 'top';
var u490 = document.getElementById('u490');

var u491 = document.getElementById('u491');

var u492 = document.getElementById('u492');

if (bIE) u492.attachEvent("onblur", LostFocusu492);
else u492.addEventListener("blur", LostFocusu492, true);
function LostFocusu492(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u493', '' + (GetWidgetFormText('u491') * GetWidgetFormText('u492')) + '');

}

}

var u493 = document.getElementById('u493');

var u494 = document.getElementById('u494');
gv_vAlignTable['u494'] = 'top';
var u495 = document.getElementById('u495');
gv_vAlignTable['u495'] = 'top';
var u496 = document.getElementById('u496');
gv_vAlignTable['u496'] = 'top';
var u100 = document.getElementById('u100');

var u101 = document.getElementById('u101');

if (bIE) u101.attachEvent("onblur", LostFocusu101);
else u101.addEventListener("blur", LostFocusu101, true);
function LostFocusu101(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u102', '' + (GetWidgetFormText('u99') * GetWidgetFormText('u101')) + '');

}

}

var u102 = document.getElementById('u102');

var u103 = document.getElementById('u103');
gv_vAlignTable['u103'] = 'top';
var u104 = document.getElementById('u104');
gv_vAlignTable['u104'] = 'top';
var u105 = document.getElementById('u105');
gv_vAlignTable['u105'] = 'top';
var u106 = document.getElementById('u106');
gv_vAlignTable['u106'] = 'top';
var u107 = document.getElementById('u107');
gv_vAlignTable['u107'] = 'top';
var u108 = document.getElementById('u108');

var u109 = document.getElementById('u109');

u109.style.cursor = 'pointer';
if (bIE) u109.attachEvent("onclick", Clicku109);
else u109.addEventListener("click", Clicku109, true);
function Clicku109(e)
{
windowEvent = e;


if (true) {

	MoveWidgetBy('u137',0,50,'swing',500);

	SetPanelVisibility('u97','hidden','none',500);

	SetPanelVisibility('u112','','fade',500);

}

}
gv_vAlignTable['u109'] = 'top';
var u297 = document.getElementById('u297');

var u298 = document.getElementById('u298');

var u299 = document.getElementById('u299');

var u500 = document.getElementById('u500');

var u392 = document.getElementById('u392');

u392.style.cursor = 'pointer';
if (bIE) u392.attachEvent("onclick", Clicku392);
else u392.addEventListener("click", Clicku392, true);
function Clicku392(e)
{
windowEvent = e;


if ((GetCheckState('u392')) == (true)) {

	MoveWidgetBy('u96',0,50,'swing',500);

	MoveWidgetBy('u137',0,50,'swing',500);

	SetPanelVisibility('u43','','fade',500);

}
else
if ((GetCheckState('u392')) == (false)) {

	SetPanelVisibility('u43','hidden','none',500);

	SetPanelVisibility('u56','hidden','none',500);

	MoveWidgetBy('u96',0,-50,'swing',500);

	MoveWidgetBy('u137',0,-50,'swing',500);

}

}

var u9 = document.getElementById('u9');

var u110 = document.getElementById('u110');

u110.style.cursor = 'pointer';
if (bIE) u110.attachEvent("onclick", Clicku110);
else u110.addEventListener("click", Clicku110, true);
function Clicku110(e)
{
windowEvent = e;


if ((GetCheckState('u110')) == (true)) {

	MoveWidgetBy('u137',0,50,'swing',500);

	SetPanelVisibility('u97','','fade',500);

}
else
if ((GetCheckState('u110')) == (false)) {

	SetPanelVisibility('u97','hidden','none',500);

	SetPanelVisibility('u112','hidden','none',500);

	MoveWidgetBy('u137',0,-50,'swing',500);

}

}

var u111 = document.getElementById('u111');
gv_vAlignTable['u111'] = 'top';
var u112 = document.getElementById('u112');

var u113 = document.getElementById('u113');

var u114 = document.getElementById('u114');

var u115 = document.getElementById('u115');

var u116 = document.getElementById('u116');

if (bIE) u116.attachEvent("onblur", LostFocusu116);
else u116.addEventListener("blur", LostFocusu116, true);
function LostFocusu116(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u117', '' + (GetWidgetFormText('u114') * GetWidgetFormText('u116')) + '');

}

}

var u117 = document.getElementById('u117');

var u118 = document.getElementById('u118');
gv_vAlignTable['u118'] = 'top';
var u119 = document.getElementById('u119');
gv_vAlignTable['u119'] = 'top';
var u510 = document.getElementById('u510');

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

var u124 = document.getElementById('u124');

var u125 = document.getElementById('u125');

var u126 = document.getElementById('u126');

var u127 = document.getElementById('u127');

if (bIE) u127.attachEvent("onblur", LostFocusu127);
else u127.addEventListener("blur", LostFocusu127, true);
function LostFocusu127(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u128', '' + (GetWidgetFormText('u125') * GetWidgetFormText('u127')) + '');

}

}

var u128 = document.getElementById('u128');

var u129 = document.getElementById('u129');
gv_vAlignTable['u129'] = 'top';
var u130 = document.getElementById('u130');
gv_vAlignTable['u130'] = 'top';
var u131 = document.getElementById('u131');
gv_vAlignTable['u131'] = 'top';
var u132 = document.getElementById('u132');
gv_vAlignTable['u132'] = 'top';
var u133 = document.getElementById('u133');
gv_vAlignTable['u133'] = 'top';
var u134 = document.getElementById('u134');

var u135 = document.getElementById('u135');

u135.style.cursor = 'pointer';
if (bIE) u135.attachEvent("onclick", Clicku135);
else u135.addEventListener("click", Clicku135, true);
function Clicku135(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u112','hidden','none',500);

	SetPanelVisibility('u97','','none',500);

	MoveWidgetBy('u137',0,-50,'swing',500);

}

}
gv_vAlignTable['u135'] = 'top';
var u136 = document.getElementById('u136');
gv_vAlignTable['u136'] = 'top';
var u137 = document.getElementById('u137');

var u138 = document.getElementById('u138');

var u139 = document.getElementById('u139');

var u140 = document.getElementById('u140');

var u141 = document.getElementById('u141');

var u142 = document.getElementById('u142');

if (bIE) u142.attachEvent("onblur", LostFocusu142);
else u142.addEventListener("blur", LostFocusu142, true);
function LostFocusu142(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u143', '' + (GetWidgetFormText('u140') * GetWidgetFormText('u142')) + '');

}

}

var u143 = document.getElementById('u143');

var u144 = document.getElementById('u144');
gv_vAlignTable['u144'] = 'top';
var u145 = document.getElementById('u145');
gv_vAlignTable['u145'] = 'top';
var u146 = document.getElementById('u146');
gv_vAlignTable['u146'] = 'top';
var u147 = document.getElementById('u147');
gv_vAlignTable['u147'] = 'top';
var u148 = document.getElementById('u148');
gv_vAlignTable['u148'] = 'top';
var u149 = document.getElementById('u149');

var u501 = document.getElementById('u501');

var u502 = document.getElementById('u502');

u502.style.cursor = 'pointer';
if (bIE) u502.attachEvent("onclick", Clicku502);
else u502.addEventListener("click", Clicku502, true);
function Clicku502(e)
{
windowEvent = e;


if ((GetCheckState('u502')) == (true)) {

	MoveWidgetBy('u96',0,50,'swing',500);

	MoveWidgetBy('u137',0,50,'swing',500);

	SetPanelVisibility('u43','','fade',500);

}
else
if ((GetCheckState('u502')) == (false)) {

	SetPanelVisibility('u43','hidden','none',500);

	SetPanelVisibility('u56','hidden','none',500);

	MoveWidgetBy('u96',0,-50,'swing',500);

	MoveWidgetBy('u137',0,-50,'swing',500);

}

}

var u503 = document.getElementById('u503');
gv_vAlignTable['u503'] = 'top';
var u10 = document.getElementById('u10');

if (bIE) u10.attachEvent("onblur", LostFocusu10);
else u10.addEventListener("blur", LostFocusu10, true);
function LostFocusu10(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u11', '' + (GetWidgetFormText('u9') * GetWidgetFormText('u10')) + '');

SetWidgetFormText('u13', '' + (GetNum(GetWidgetFormText('u11')) + GetNum(GetWidgetFormText('u17'))) + '');

}

}

var u11 = document.getElementById('u11');

var u12 = document.getElementById('u12');
gv_vAlignTable['u12'] = 'top';
var u13 = document.getElementById('u13');

var u14 = document.getElementById('u14');

var u15 = document.getElementById('u15');

var u16 = document.getElementById('u16');

if (bIE) u16.attachEvent("onblur", LostFocusu16);
else u16.addEventListener("blur", LostFocusu16, true);
function LostFocusu16(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u17', '' + (GetWidgetFormText('u15') * GetWidgetFormText('u16')) + '');

}

}

var u17 = document.getElementById('u17');

var u18 = document.getElementById('u18');
gv_vAlignTable['u18'] = 'top';
var u19 = document.getElementById('u19');
gv_vAlignTable['u19'] = 'top';
var u150 = document.getElementById('u150');

u150.style.cursor = 'pointer';
if (bIE) u150.attachEvent("onclick", Clicku150);
else u150.addEventListener("click", Clicku150, true);
function Clicku150(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u138','hidden','none',500);

	SetPanelVisibility('u153','','fade',500);

}

}
gv_vAlignTable['u150'] = 'top';
var u151 = document.getElementById('u151');

u151.style.cursor = 'pointer';
if (bIE) u151.attachEvent("onclick", Clicku151);
else u151.addEventListener("click", Clicku151, true);
function Clicku151(e)
{
windowEvent = e;


if ((GetCheckState('u151')) == (true)) {

	SetPanelVisibility('u138','','fade',500);

}
else
if ((GetCheckState('u151')) == (false)) {

	SetPanelVisibility('u138','hidden','none',500);

	SetPanelVisibility('u153','hidden','none',500);

}

}

var u152 = document.getElementById('u152');
gv_vAlignTable['u152'] = 'top';
var u153 = document.getElementById('u153');

var u154 = document.getElementById('u154');

var u155 = document.getElementById('u155');

var u156 = document.getElementById('u156');

var u157 = document.getElementById('u157');

if (bIE) u157.attachEvent("onblur", LostFocusu157);
else u157.addEventListener("blur", LostFocusu157, true);
function LostFocusu157(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u158', '' + (GetWidgetFormText('u155') * GetWidgetFormText('u157')) + '');

}

}

var u158 = document.getElementById('u158');

var u159 = document.getElementById('u159');
gv_vAlignTable['u159'] = 'top';
var u511 = document.getElementById('u511');

var u512 = document.getElementById('u512');

var u513 = document.getElementById('u513');
gv_vAlignTable['u513'] = 'center';
var u20 = document.getElementById('u20');
gv_vAlignTable['u20'] = 'top';
var u21 = document.getElementById('u21');
gv_vAlignTable['u21'] = 'top';
var u22 = document.getElementById('u22');
gv_vAlignTable['u22'] = 'top';
var u23 = document.getElementById('u23');

var u24 = document.getElementById('u24');

var u25 = document.getElementById('u25');

var u26 = document.getElementById('u26');

u26.style.cursor = 'pointer';
if (bIE) u26.attachEvent("onclick", Clicku26);
else u26.addEventListener("click", Clicku26, true);
function Clicku26(e)
{
windowEvent = e;


if ((GetCheckState('u26')) == (true)) {

	MoveWidgetBy('u96',0,50,'swing',500);

	MoveWidgetBy('u137',0,50,'swing',500);

	SetPanelVisibility('u43','','fade',500);

}
else
if ((GetCheckState('u26')) == (false)) {

	SetPanelVisibility('u43','hidden','none',500);

	SetPanelVisibility('u56','hidden','none',500);

	MoveWidgetBy('u96',0,-50,'swing',500);

	MoveWidgetBy('u137',0,-50,'swing',500);

}

}

var u27 = document.getElementById('u27');
gv_vAlignTable['u27'] = 'top';
var u28 = document.getElementById('u28');

var u29 = document.getElementById('u29');

var u160 = document.getElementById('u160');
gv_vAlignTable['u160'] = 'top';
var u161 = document.getElementById('u161');
gv_vAlignTable['u161'] = 'top';
var u162 = document.getElementById('u162');
gv_vAlignTable['u162'] = 'top';
var u163 = document.getElementById('u163');
gv_vAlignTable['u163'] = 'top';
var u164 = document.getElementById('u164');

var u165 = document.getElementById('u165');

var u166 = document.getElementById('u166');

var u167 = document.getElementById('u167');

var u168 = document.getElementById('u168');

if (bIE) u168.attachEvent("onblur", LostFocusu168);
else u168.addEventListener("blur", LostFocusu168, true);
function LostFocusu168(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u169', '' + (GetWidgetFormText('u166') * GetWidgetFormText('u168')) + '');

}

}

var u169 = document.getElementById('u169');

var u521 = document.getElementById('u521');

var u522 = document.getElementById('u522');
gv_vAlignTable['u522'] = 'top';
var u203 = document.getElementById('u203');

var u30 = document.getElementById('u30');
gv_vAlignTable['u30'] = 'center';
var u31 = document.getElementById('u31');

var u206 = document.getElementById('u206');
gv_vAlignTable['u206'] = 'top';
var u207 = document.getElementById('u207');

var u208 = document.getElementById('u208');

var u209 = document.getElementById('u209');

var u36 = document.getElementById('u36');

var u37 = document.getElementById('u37');
gv_vAlignTable['u37'] = 'center';
var u38 = document.getElementById('u38');
gv_vAlignTable['u38'] = 'top';
var u39 = document.getElementById('u39');
gv_vAlignTable['u39'] = 'top';
var u170 = document.getElementById('u170');
gv_vAlignTable['u170'] = 'top';
var u171 = document.getElementById('u171');
gv_vAlignTable['u171'] = 'top';
var u172 = document.getElementById('u172');
gv_vAlignTable['u172'] = 'top';
var u173 = document.getElementById('u173');
gv_vAlignTable['u173'] = 'top';
var u174 = document.getElementById('u174');
gv_vAlignTable['u174'] = 'top';
var u175 = document.getElementById('u175');

var u176 = document.getElementById('u176');

u176.style.cursor = 'pointer';
if (bIE) u176.attachEvent("onclick", Clicku176);
else u176.addEventListener("click", Clicku176, true);
function Clicku176(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u153','hidden','none',500);

	SetPanelVisibility('u138','','none',500);

}

}
gv_vAlignTable['u176'] = 'top';
var u177 = document.getElementById('u177');
gv_vAlignTable['u177'] = 'top';
var u178 = document.getElementById('u178');

var u179 = document.getElementById('u179');

u179.style.cursor = 'pointer';
if (bIE) u179.attachEvent("onclick", Clicku179);
else u179.addEventListener("click", Clicku179, true);
function Clicku179(e)
{
windowEvent = e;


if (true) {

	self.location.href="cm-passo-1-dados-projeto.html" + GetQuerystring();

}

}

var u531 = document.getElementById('u531');
gv_vAlignTable['u531'] = 'top';
var u532 = document.getElementById('u532');
gv_vAlignTable['u532'] = 'top';
var u533 = document.getElementById('u533');

var u40 = document.getElementById('u40');
gv_vAlignTable['u40'] = 'top';
var u41 = document.getElementById('u41');
gv_vAlignTable['u41'] = 'top';
var u42 = document.getElementById('u42');
gv_vAlignTable['u42'] = 'top';
var u43 = document.getElementById('u43');

var u44 = document.getElementById('u44');

var u45 = document.getElementById('u45');

var u46 = document.getElementById('u46');

var u47 = document.getElementById('u47');

if (bIE) u47.attachEvent("onblur", LostFocusu47);
else u47.addEventListener("blur", LostFocusu47, true);
function LostFocusu47(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u48', '' + (GetWidgetFormText('u45') * GetWidgetFormText('u47')) + '');

}

}

var u48 = document.getElementById('u48');

var u49 = document.getElementById('u49');
gv_vAlignTable['u49'] = 'top';
var u180 = document.getElementById('u180');
gv_vAlignTable['u180'] = 'center';
var u181 = document.getElementById('u181');

u181.style.cursor = 'pointer';
if (bIE) u181.attachEvent("onclick", Clicku181);
else u181.addEventListener("click", Clicku181, true);
function Clicku181(e)
{
windowEvent = e;


if (true) {

	self.location.href="passo-2.2-dados-diretor.html" + GetQuerystring();

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

	self.location.href="passo-3.2-dados-produtor.html" + GetQuerystring();

}

}

var u184 = document.getElementById('u184');
gv_vAlignTable['u184'] = 'center';
var u185 = document.getElementById('u185');
gv_vAlignTable['u185'] = 'top';
var u186 = document.getElementById('u186');
gv_vAlignTable['u186'] = 'top';
var u187 = document.getElementById('u187');
gv_vAlignTable['u187'] = 'top';
var u188 = document.getElementById('u188');

var u189 = document.getElementById('u189');

var u541 = document.getElementById('u541');
gv_vAlignTable['u541'] = 'center';
var u542 = document.getElementById('u542');

var u543 = document.getElementById('u543');
gv_vAlignTable['u543'] = 'center';
var u50 = document.getElementById('u50');
gv_vAlignTable['u50'] = 'top';
var u51 = document.getElementById('u51');
gv_vAlignTable['u51'] = 'top';
var u52 = document.getElementById('u52');
gv_vAlignTable['u52'] = 'top';
var u53 = document.getElementById('u53');
gv_vAlignTable['u53'] = 'top';
var u54 = document.getElementById('u54');

var u55 = document.getElementById('u55');

u55.style.cursor = 'pointer';
if (bIE) u55.attachEvent("onclick", Clicku55);
else u55.addEventListener("click", Clicku55, true);
function Clicku55(e)
{
windowEvent = e;


if (true) {

	MoveWidgetBy('u96',0,60,'swing',500);

	MoveWidgetBy('u137',0,60,'swing',500);

	SetPanelVisibility('u43','hidden','none',500);

	SetPanelVisibility('u56','','fade',500);

	BringToFront("u56");

}

}
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

	SetPanelVisibility('u56','hidden','none',500);

	SetPanelVisibility('u43','','none',500);

	BringToFront("u43");

	MoveWidgetBy('u96',0,-60,'swing',500);

	MoveWidgetBy('u137',0,-60,'swing',500);

}

}
gv_vAlignTable['u57'] = 'top';
var u58 = document.getElementById('u58');

u58.style.cursor = 'pointer';
if (bIE) u58.attachEvent("onclick", Clicku58);
else u58.addEventListener("click", Clicku58, true);
function Clicku58(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u56','','none',500);

	SetPanelVisibility('u43','hidden','none',500);

	BringToFront("u56");

}

}
gv_vAlignTable['u58'] = 'top';
var u59 = document.getElementById('u59');

var u190 = document.getElementById('u190');

var u191 = document.getElementById('u191');
gv_vAlignTable['u191'] = 'center';
var u192 = document.getElementById('u192');

var u193 = document.getElementById('u193');
gv_vAlignTable['u193'] = 'center';
var u194 = document.getElementById('u194');

u194.style.cursor = 'pointer';
if (bIE) u194.attachEvent("onclick", Clicku194);
else u194.addEventListener("click", Clicku194, true);
function Clicku194(e)
{
windowEvent = e;


if (true) {

	self.location.href="cm-passo-5-envio.html" + GetQuerystring();

}

}

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

	self.location.href="passo-3.2-dados-produtor.html" + GetQuerystring();

}

}

var u197 = document.getElementById('u197');
gv_vAlignTable['u197'] = 'center';
var u198 = document.getElementById('u198');

var u199 = document.getElementById('u199');
gv_vAlignTable['u199'] = 'center';
var u551 = document.getElementById('u551');
gv_vAlignTable['u551'] = 'top';
var u552 = document.getElementById('u552');

var u553 = document.getElementById('u553');
gv_vAlignTable['u553'] = 'top';
var u60 = document.getElementById('u60');

var u61 = document.getElementById('u61');

if (bIE) u61.attachEvent("onblur", LostFocusu61);
else u61.addEventListener("blur", LostFocusu61, true);
function LostFocusu61(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u62', '' + (GetWidgetFormText('u60') * GetWidgetFormText('u61')) + '');

SetWidgetFormText('u69', '' + (GetNum(GetWidgetFormText('u62')) + GetNum(GetWidgetFormText('u73'))) + '');

}

}

var u62 = document.getElementById('u62');

var u63 = document.getElementById('u63');
gv_vAlignTable['u63'] = 'top';
var u64 = document.getElementById('u64');
gv_vAlignTable['u64'] = 'top';
var u65 = document.getElementById('u65');
gv_vAlignTable['u65'] = 'top';
var u66 = document.getElementById('u66');
gv_vAlignTable['u66'] = 'top';
var u67 = document.getElementById('u67');
gv_vAlignTable['u67'] = 'top';
var u68 = document.getElementById('u68');
gv_vAlignTable['u68'] = 'top';
var u69 = document.getElementById('u69');

var u70 = document.getElementById('u70');

var u71 = document.getElementById('u71');

var u72 = document.getElementById('u72');

if (bIE) u72.attachEvent("onblur", LostFocusu72);
else u72.addEventListener("blur", LostFocusu72, true);
function LostFocusu72(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u73', '' + (GetWidgetFormText('u71') * GetWidgetFormText('u72')) + '');

}

}

var u73 = document.getElementById('u73');

var u74 = document.getElementById('u74');
gv_vAlignTable['u74'] = 'top';
var u75 = document.getElementById('u75');
gv_vAlignTable['u75'] = 'top';
var u76 = document.getElementById('u76');
gv_vAlignTable['u76'] = 'top';
var u77 = document.getElementById('u77');
gv_vAlignTable['u77'] = 'top';
var u78 = document.getElementById('u78');
gv_vAlignTable['u78'] = 'top';
var u79 = document.getElementById('u79');

var u80 = document.getElementById('u80');

var u81 = document.getElementById('u81');

var u82 = document.getElementById('u82');

var u83 = document.getElementById('u83');
gv_vAlignTable['u83'] = 'center';
var u84 = document.getElementById('u84');

var u85 = document.getElementById('u85');
gv_vAlignTable['u85'] = 'center';
var u86 = document.getElementById('u86');
gv_vAlignTable['u86'] = 'top';
var u87 = document.getElementById('u87');
gv_vAlignTable['u87'] = 'top';
var u88 = document.getElementById('u88');
gv_vAlignTable['u88'] = 'top';
var u89 = document.getElementById('u89');

var u90 = document.getElementById('u90');

var u91 = document.getElementById('u91');

u91.style.cursor = 'pointer';
if (bIE) u91.attachEvent("onclick", Clicku91);
else u91.addEventListener("click", Clicku91, true);
function Clicku91(e)
{
windowEvent = e;


if ((GetCheckState('u91')) == (true)) {

	MoveWidgetBy('u96',0,50,'swing',500);

	MoveWidgetBy('u137',0,50,'swing',500);

	SetPanelVisibility('u43','','fade',500);

}
else
if ((GetCheckState('u91')) == (false)) {

	SetPanelVisibility('u43','hidden','none',500);

	SetPanelVisibility('u56','hidden','none',500);

	MoveWidgetBy('u96',0,-50,'swing',500);

	MoveWidgetBy('u137',0,-50,'swing',500);

}

}

var u92 = document.getElementById('u92');
gv_vAlignTable['u92'] = 'top';
var u93 = document.getElementById('u93');

var u94 = document.getElementById('u94');
gv_vAlignTable['u94'] = 'top';
var u95 = document.getElementById('u95');

var u96 = document.getElementById('u96');

var u97 = document.getElementById('u97');

var u98 = document.getElementById('u98');

var u99 = document.getElementById('u99');

var u400 = document.getElementById('u400');
gv_vAlignTable['u400'] = 'top';
var u401 = document.getElementById('u401');
gv_vAlignTable['u401'] = 'top';
var u402 = document.getElementById('u402');

var u403 = document.getElementById('u403');

if (bIE) u403.attachEvent("onblur", LostFocusu403);
else u403.addEventListener("blur", LostFocusu403, true);
function LostFocusu403(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u404', '' + (GetWidgetFormText('u402') * GetWidgetFormText('u403')) + '');

SetWidgetFormText('u406', '' + (GetNum(GetWidgetFormText('u404')) + GetNum(GetWidgetFormText('u410'))) + '');

}

}

var u404 = document.getElementById('u404');

var u405 = document.getElementById('u405');
gv_vAlignTable['u405'] = 'top';
var u406 = document.getElementById('u406');

var u407 = document.getElementById('u407');

var u408 = document.getElementById('u408');

var u409 = document.getElementById('u409');

if (bIE) u409.attachEvent("onblur", LostFocusu409);
else u409.addEventListener("blur", LostFocusu409, true);
function LostFocusu409(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u410', '' + (GetWidgetFormText('u408') * GetWidgetFormText('u409')) + '');

}

}

var u410 = document.getElementById('u410');

var u411 = document.getElementById('u411');
gv_vAlignTable['u411'] = 'top';
var u412 = document.getElementById('u412');
gv_vAlignTable['u412'] = 'top';
var u413 = document.getElementById('u413');
gv_vAlignTable['u413'] = 'top';
var u414 = document.getElementById('u414');
gv_vAlignTable['u414'] = 'top';
var u415 = document.getElementById('u415');
gv_vAlignTable['u415'] = 'top';
var u416 = document.getElementById('u416');

var u417 = document.getElementById('u417');

var u418 = document.getElementById('u418');

var u419 = document.getElementById('u419');

u419.style.cursor = 'pointer';
if (bIE) u419.attachEvent("onclick", Clicku419);
else u419.addEventListener("click", Clicku419, true);
function Clicku419(e)
{
windowEvent = e;


if ((GetCheckState('u419')) == (true)) {

	MoveWidgetBy('u96',0,50,'swing',500);

	MoveWidgetBy('u137',0,50,'swing',500);

	SetPanelVisibility('u43','','fade',500);

}
else
if ((GetCheckState('u419')) == (false)) {

	SetPanelVisibility('u43','hidden','none',500);

	SetPanelVisibility('u56','hidden','none',500);

	MoveWidgetBy('u96',0,-50,'swing',500);

	MoveWidgetBy('u137',0,-50,'swing',500);

}

}

var u420 = document.getElementById('u420');
gv_vAlignTable['u420'] = 'top';
var u421 = document.getElementById('u421');

var u422 = document.getElementById('u422');

var u423 = document.getElementById('u423');
gv_vAlignTable['u423'] = 'center';
var u424 = document.getElementById('u424');
gv_vAlignTable['u424'] = 'top';
var u425 = document.getElementById('u425');

var u426 = document.getElementById('u426');
gv_vAlignTable['u426'] = 'center';
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

var u294 = document.getElementById('u294');

if (bIE) u294.attachEvent("onblur", LostFocusu294);
else u294.addEventListener("blur", LostFocusu294, true);
function LostFocusu294(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u295', '' + (GetWidgetFormText('u293') * GetWidgetFormText('u294')) + '');

SetWidgetFormText('u297', '' + (GetNum(GetWidgetFormText('u295')) + GetNum(GetWidgetFormText('u301'))) + '');

}

}

var u295 = document.getElementById('u295');

var u296 = document.getElementById('u296');
gv_vAlignTable['u296'] = 'top';
var u430 = document.getElementById('u430');

var u431 = document.getElementById('u431');
gv_vAlignTable['u431'] = 'center';
var u432 = document.getElementById('u432');
gv_vAlignTable['u432'] = 'top';
var u433 = document.getElementById('u433');
gv_vAlignTable['u433'] = 'top';
var u434 = document.getElementById('u434');
gv_vAlignTable['u434'] = 'top';
var u435 = document.getElementById('u435');
gv_vAlignTable['u435'] = 'top';
var u436 = document.getElementById('u436');
gv_vAlignTable['u436'] = 'top';
var u437 = document.getElementById('u437');

var u438 = document.getElementById('u438');

if (bIE) u438.attachEvent("onblur", LostFocusu438);
else u438.addEventListener("blur", LostFocusu438, true);
function LostFocusu438(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u439', '' + (GetWidgetFormText('u437') * GetWidgetFormText('u438')) + '');

SetWidgetFormText('u441', '' + (GetNum(GetWidgetFormText('u439')) + GetNum(GetWidgetFormText('u445'))) + '');

}

}

var u439 = document.getElementById('u439');

var u440 = document.getElementById('u440');
gv_vAlignTable['u440'] = 'top';
var u441 = document.getElementById('u441');

var u442 = document.getElementById('u442');

var u443 = document.getElementById('u443');

var u444 = document.getElementById('u444');

if (bIE) u444.attachEvent("onblur", LostFocusu444);
else u444.addEventListener("blur", LostFocusu444, true);
function LostFocusu444(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u445', '' + (GetWidgetFormText('u443') * GetWidgetFormText('u444')) + '');

}

}

var u445 = document.getElementById('u445');

var u446 = document.getElementById('u446');
gv_vAlignTable['u446'] = 'top';
var u447 = document.getElementById('u447');
gv_vAlignTable['u447'] = 'top';
var u448 = document.getElementById('u448');
gv_vAlignTable['u448'] = 'top';
var u449 = document.getElementById('u449');
gv_vAlignTable['u449'] = 'top';
var u450 = document.getElementById('u450');
gv_vAlignTable['u450'] = 'top';
var u451 = document.getElementById('u451');

var u452 = document.getElementById('u452');

var u453 = document.getElementById('u453');

var u454 = document.getElementById('u454');

u454.style.cursor = 'pointer';
if (bIE) u454.attachEvent("onclick", Clicku454);
else u454.addEventListener("click", Clicku454, true);
function Clicku454(e)
{
windowEvent = e;


if ((GetCheckState('u454')) == (true)) {

	MoveWidgetBy('u96',0,50,'swing',500);

	MoveWidgetBy('u137',0,50,'swing',500);

	SetPanelVisibility('u43','','fade',500);

}
else
if ((GetCheckState('u454')) == (false)) {

	SetPanelVisibility('u43','hidden','none',500);

	SetPanelVisibility('u56','hidden','none',500);

	MoveWidgetBy('u96',0,-50,'swing',500);

	MoveWidgetBy('u137',0,-50,'swing',500);

}

}

var u455 = document.getElementById('u455');
gv_vAlignTable['u455'] = 'top';
var u456 = document.getElementById('u456');
gv_vAlignTable['u456'] = 'top';
var u457 = document.getElementById('u457');
gv_vAlignTable['u457'] = 'top';
var u458 = document.getElementById('u458');
gv_vAlignTable['u458'] = 'top';
var u459 = document.getElementById('u459');
gv_vAlignTable['u459'] = 'top';
var u460 = document.getElementById('u460');
gv_vAlignTable['u460'] = 'top';
var u461 = document.getElementById('u461');

var u462 = document.getElementById('u462');

if (bIE) u462.attachEvent("onblur", LostFocusu462);
else u462.addEventListener("blur", LostFocusu462, true);
function LostFocusu462(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u463', '' + (GetWidgetFormText('u461') * GetWidgetFormText('u462')) + '');

SetWidgetFormText('u465', '' + (GetNum(GetWidgetFormText('u463')) + GetNum(GetWidgetFormText('u469'))) + '');

}

}

var u463 = document.getElementById('u463');

var u464 = document.getElementById('u464');
gv_vAlignTable['u464'] = 'top';
var u465 = document.getElementById('u465');

var u466 = document.getElementById('u466');

var u467 = document.getElementById('u467');

var u468 = document.getElementById('u468');

if (bIE) u468.attachEvent("onblur", LostFocusu468);
else u468.addEventListener("blur", LostFocusu468, true);
function LostFocusu468(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u469', '' + (GetWidgetFormText('u467') * GetWidgetFormText('u468')) + '');

}

}

var u469 = document.getElementById('u469');

var u470 = document.getElementById('u470');
gv_vAlignTable['u470'] = 'top';
var u471 = document.getElementById('u471');
gv_vAlignTable['u471'] = 'top';
var u472 = document.getElementById('u472');
gv_vAlignTable['u472'] = 'top';
var u473 = document.getElementById('u473');
gv_vAlignTable['u473'] = 'top';
var u474 = document.getElementById('u474');
gv_vAlignTable['u474'] = 'top';
var u475 = document.getElementById('u475');

var u476 = document.getElementById('u476');

var u477 = document.getElementById('u477');

var u478 = document.getElementById('u478');

u478.style.cursor = 'pointer';
if (bIE) u478.attachEvent("onclick", Clicku478);
else u478.addEventListener("click", Clicku478, true);
function Clicku478(e)
{
windowEvent = e;


if ((GetCheckState('u478')) == (true)) {

	MoveWidgetBy('u96',0,50,'swing',500);

	MoveWidgetBy('u137',0,50,'swing',500);

	SetPanelVisibility('u43','','fade',500);

}
else
if ((GetCheckState('u478')) == (false)) {

	SetPanelVisibility('u43','hidden','none',500);

	SetPanelVisibility('u56','hidden','none',500);

	MoveWidgetBy('u96',0,-50,'swing',500);

	MoveWidgetBy('u137',0,-50,'swing',500);

}

}

var u479 = document.getElementById('u479');
gv_vAlignTable['u479'] = 'top';
var u480 = document.getElementById('u480');
gv_vAlignTable['u480'] = 'top';
var u481 = document.getElementById('u481');
gv_vAlignTable['u481'] = 'top';
var u482 = document.getElementById('u482');
gv_vAlignTable['u482'] = 'top';
var u483 = document.getElementById('u483');
gv_vAlignTable['u483'] = 'top';
var u484 = document.getElementById('u484');
gv_vAlignTable['u484'] = 'top';
var u485 = document.getElementById('u485');

var u486 = document.getElementById('u486');

if (bIE) u486.attachEvent("onblur", LostFocusu486);
else u486.addEventListener("blur", LostFocusu486, true);
function LostFocusu486(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u487', '' + (GetWidgetFormText('u485') * GetWidgetFormText('u486')) + '');

SetWidgetFormText('u489', '' + (GetNum(GetWidgetFormText('u487')) + GetNum(GetWidgetFormText('u493'))) + '');

}

}

var u487 = document.getElementById('u487');

var u488 = document.getElementById('u488');
gv_vAlignTable['u488'] = 'top';
var u489 = document.getElementById('u489');

var u204 = document.getElementById('u204');

if (bIE) u204.attachEvent("onblur", LostFocusu204);
else u204.addEventListener("blur", LostFocusu204, true);
function LostFocusu204(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u205', '' + (GetWidgetFormText('u203') * GetWidgetFormText('u204')) + '');

SetWidgetFormText('u207', '' + (GetNum(GetWidgetFormText('u205')) + GetNum(GetWidgetFormText('u211'))) + '');

}

}

var u300 = document.getElementById('u300');

if (bIE) u300.attachEvent("onblur", LostFocusu300);
else u300.addEventListener("blur", LostFocusu300, true);
function LostFocusu300(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u301', '' + (GetWidgetFormText('u299') * GetWidgetFormText('u300')) + '');

}

}

var u301 = document.getElementById('u301');

var u302 = document.getElementById('u302');
gv_vAlignTable['u302'] = 'top';
var u303 = document.getElementById('u303');
gv_vAlignTable['u303'] = 'top';
var u304 = document.getElementById('u304');
gv_vAlignTable['u304'] = 'top';
var u305 = document.getElementById('u305');
gv_vAlignTable['u305'] = 'top';
var u306 = document.getElementById('u306');
gv_vAlignTable['u306'] = 'top';
var u307 = document.getElementById('u307');

var u308 = document.getElementById('u308');

var u309 = document.getElementById('u309');

var u497 = document.getElementById('u497');
gv_vAlignTable['u497'] = 'top';
var u498 = document.getElementById('u498');
gv_vAlignTable['u498'] = 'top';
var u499 = document.getElementById('u499');

var u504 = document.getElementById('u504');

var u505 = document.getElementById('u505');

var u506 = document.getElementById('u506');
gv_vAlignTable['u506'] = 'center';
var u507 = document.getElementById('u507');
gv_vAlignTable['u507'] = 'top';
var u508 = document.getElementById('u508');
gv_vAlignTable['u508'] = 'top';
var u509 = document.getElementById('u509');
gv_vAlignTable['u509'] = 'top';
var u310 = document.getElementById('u310');

u310.style.cursor = 'pointer';
if (bIE) u310.attachEvent("onclick", Clicku310);
else u310.addEventListener("click", Clicku310, true);
function Clicku310(e)
{
windowEvent = e;


if ((GetCheckState('u310')) == (true)) {

	MoveWidgetBy('u96',0,50,'swing',500);

	MoveWidgetBy('u137',0,50,'swing',500);

	SetPanelVisibility('u43','','fade',500);

}
else
if ((GetCheckState('u310')) == (false)) {

	SetPanelVisibility('u43','hidden','none',500);

	SetPanelVisibility('u56','hidden','none',500);

	MoveWidgetBy('u96',0,-50,'swing',500);

	MoveWidgetBy('u137',0,-50,'swing',500);

}

}

var u311 = document.getElementById('u311');
gv_vAlignTable['u311'] = 'top';
var u312 = document.getElementById('u312');
gv_vAlignTable['u312'] = 'top';
var u313 = document.getElementById('u313');
gv_vAlignTable['u313'] = 'top';
var u314 = document.getElementById('u314');
gv_vAlignTable['u314'] = 'top';
var u315 = document.getElementById('u315');
gv_vAlignTable['u315'] = 'top';
var u316 = document.getElementById('u316');
gv_vAlignTable['u316'] = 'top';
var u317 = document.getElementById('u317');

var u318 = document.getElementById('u318');

if (bIE) u318.attachEvent("onblur", LostFocusu318);
else u318.addEventListener("blur", LostFocusu318, true);
function LostFocusu318(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u319', '' + (GetWidgetFormText('u317') * GetWidgetFormText('u318')) + '');

SetWidgetFormText('u321', '' + (GetNum(GetWidgetFormText('u319')) + GetNum(GetWidgetFormText('u325'))) + '');

}

}

var u319 = document.getElementById('u319');

var u514 = document.getElementById('u514');
gv_vAlignTable['u514'] = 'top';
var u515 = document.getElementById('u515');
gv_vAlignTable['u515'] = 'top';
var u516 = document.getElementById('u516');
gv_vAlignTable['u516'] = 'top';
var u517 = document.getElementById('u517');
gv_vAlignTable['u517'] = 'top';
var u518 = document.getElementById('u518');
gv_vAlignTable['u518'] = 'top';
var u519 = document.getElementById('u519');

var u320 = document.getElementById('u320');
gv_vAlignTable['u320'] = 'top';
var u321 = document.getElementById('u321');

var u322 = document.getElementById('u322');

var u323 = document.getElementById('u323');

var u324 = document.getElementById('u324');

if (bIE) u324.attachEvent("onblur", LostFocusu324);
else u324.addEventListener("blur", LostFocusu324, true);
function LostFocusu324(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u325', '' + (GetWidgetFormText('u323') * GetWidgetFormText('u324')) + '');

}

}

var u325 = document.getElementById('u325');

var u326 = document.getElementById('u326');
gv_vAlignTable['u326'] = 'top';
var u327 = document.getElementById('u327');
gv_vAlignTable['u327'] = 'top';
var u328 = document.getElementById('u328');
gv_vAlignTable['u328'] = 'top';
var u329 = document.getElementById('u329');
gv_vAlignTable['u329'] = 'top';
var u520 = document.getElementById('u520');

if (bIE) u520.attachEvent("onblur", LostFocusu520);
else u520.addEventListener("blur", LostFocusu520, true);
function LostFocusu520(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u521', '' + (GetWidgetFormText('u519') * GetWidgetFormText('u520')) + '');

SetWidgetFormText('u523', '' + (GetNum(GetWidgetFormText('u521')) + GetNum(GetWidgetFormText('u527'))) + '');

}

}

var u523 = document.getElementById('u523');

var u524 = document.getElementById('u524');

var u525 = document.getElementById('u525');

var u526 = document.getElementById('u526');

if (bIE) u526.attachEvent("onblur", LostFocusu526);
else u526.addEventListener("blur", LostFocusu526, true);
function LostFocusu526(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u527', '' + (GetWidgetFormText('u525') * GetWidgetFormText('u526')) + '');

}

}

var u527 = document.getElementById('u527');

var u528 = document.getElementById('u528');
gv_vAlignTable['u528'] = 'top';
var u529 = document.getElementById('u529');
gv_vAlignTable['u529'] = 'top';
var u330 = document.getElementById('u330');
gv_vAlignTable['u330'] = 'top';
var u331 = document.getElementById('u331');

var u332 = document.getElementById('u332');

var u333 = document.getElementById('u333');

var u334 = document.getElementById('u334');

u334.style.cursor = 'pointer';
if (bIE) u334.attachEvent("onclick", Clicku334);
else u334.addEventListener("click", Clicku334, true);
function Clicku334(e)
{
windowEvent = e;


if ((GetCheckState('u334')) == (true)) {

	MoveWidgetBy('u96',0,50,'swing',500);

	MoveWidgetBy('u137',0,50,'swing',500);

	SetPanelVisibility('u43','','fade',500);

}
else
if ((GetCheckState('u334')) == (false)) {

	SetPanelVisibility('u43','hidden','none',500);

	SetPanelVisibility('u56','hidden','none',500);

	MoveWidgetBy('u96',0,-50,'swing',500);

	MoveWidgetBy('u137',0,-50,'swing',500);

}

}

var u335 = document.getElementById('u335');
gv_vAlignTable['u335'] = 'top';
var u336 = document.getElementById('u336');
gv_vAlignTable['u336'] = 'top';
var u337 = document.getElementById('u337');
gv_vAlignTable['u337'] = 'top';
var u338 = document.getElementById('u338');
gv_vAlignTable['u338'] = 'top';
var u339 = document.getElementById('u339');
gv_vAlignTable['u339'] = 'top';
var u530 = document.getElementById('u530');
gv_vAlignTable['u530'] = 'top';
var u534 = document.getElementById('u534');

var u535 = document.getElementById('u535');

var u536 = document.getElementById('u536');

u536.style.cursor = 'pointer';
if (bIE) u536.attachEvent("onclick", Clicku536);
else u536.addEventListener("click", Clicku536, true);
function Clicku536(e)
{
windowEvent = e;


if ((GetCheckState('u536')) == (true)) {

	MoveWidgetBy('u96',0,50,'swing',500);

	MoveWidgetBy('u137',0,50,'swing',500);

	SetPanelVisibility('u43','','fade',500);

}
else
if ((GetCheckState('u536')) == (false)) {

	SetPanelVisibility('u43','hidden','none',500);

	SetPanelVisibility('u56','hidden','none',500);

	MoveWidgetBy('u96',0,-50,'swing',500);

	MoveWidgetBy('u137',0,-50,'swing',500);

}

}

var u537 = document.getElementById('u537');
gv_vAlignTable['u537'] = 'top';
var u538 = document.getElementById('u538');

var u539 = document.getElementById('u539');
gv_vAlignTable['u539'] = 'top';
var u340 = document.getElementById('u340');
gv_vAlignTable['u340'] = 'top';
var u341 = document.getElementById('u341');

var u342 = document.getElementById('u342');

if (bIE) u342.attachEvent("onblur", LostFocusu342);
else u342.addEventListener("blur", LostFocusu342, true);
function LostFocusu342(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u343', '' + (GetWidgetFormText('u341') * GetWidgetFormText('u342')) + '');

SetWidgetFormText('u345', '' + (GetNum(GetWidgetFormText('u343')) + GetNum(GetWidgetFormText('u349'))) + '');

}

}

var u343 = document.getElementById('u343');

var u344 = document.getElementById('u344');
gv_vAlignTable['u344'] = 'top';
var u345 = document.getElementById('u345');

var u346 = document.getElementById('u346');

var u347 = document.getElementById('u347');

var u348 = document.getElementById('u348');

if (bIE) u348.attachEvent("onblur", LostFocusu348);
else u348.addEventListener("blur", LostFocusu348, true);
function LostFocusu348(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u349', '' + (GetWidgetFormText('u347') * GetWidgetFormText('u348')) + '');

}

}

var u349 = document.getElementById('u349');

var u540 = document.getElementById('u540');

var u544 = document.getElementById('u544');
gv_vAlignTable['u544'] = 'top';
var u545 = document.getElementById('u545');
gv_vAlignTable['u545'] = 'top';
var u546 = document.getElementById('u546');
gv_vAlignTable['u546'] = 'top';
var u547 = document.getElementById('u547');
gv_vAlignTable['u547'] = 'top';
var u548 = document.getElementById('u548');
gv_vAlignTable['u548'] = 'top';
var u549 = document.getElementById('u549');
gv_vAlignTable['u549'] = 'top';
var u350 = document.getElementById('u350');
gv_vAlignTable['u350'] = 'top';
var u351 = document.getElementById('u351');
gv_vAlignTable['u351'] = 'top';
var u352 = document.getElementById('u352');
gv_vAlignTable['u352'] = 'top';
var u353 = document.getElementById('u353');
gv_vAlignTable['u353'] = 'top';
var u354 = document.getElementById('u354');
gv_vAlignTable['u354'] = 'top';
var u355 = document.getElementById('u355');

var u356 = document.getElementById('u356');

var u357 = document.getElementById('u357');

var u358 = document.getElementById('u358');

u358.style.cursor = 'pointer';
if (bIE) u358.attachEvent("onclick", Clicku358);
else u358.addEventListener("click", Clicku358, true);
function Clicku358(e)
{
windowEvent = e;


if ((GetCheckState('u358')) == (true)) {

	MoveWidgetBy('u96',0,50,'swing',500);

	MoveWidgetBy('u137',0,50,'swing',500);

	SetPanelVisibility('u43','','fade',500);

}
else
if ((GetCheckState('u358')) == (false)) {

	SetPanelVisibility('u43','hidden','none',500);

	SetPanelVisibility('u56','hidden','none',500);

	MoveWidgetBy('u96',0,-50,'swing',500);

	MoveWidgetBy('u137',0,-50,'swing',500);

}

}

var u359 = document.getElementById('u359');
gv_vAlignTable['u359'] = 'top';
var u550 = document.getElementById('u550');
gv_vAlignTable['u550'] = 'top';
var u554 = document.getElementById('u554');

var u360 = document.getElementById('u360');

var u361 = document.getElementById('u361');

var u362 = document.getElementById('u362');
gv_vAlignTable['u362'] = 'center';
var u363 = document.getElementById('u363');
gv_vAlignTable['u363'] = 'top';
var u364 = document.getElementById('u364');
gv_vAlignTable['u364'] = 'top';
var u365 = document.getElementById('u365');
gv_vAlignTable['u365'] = 'top';
var u366 = document.getElementById('u366');

var u367 = document.getElementById('u367');

var u368 = document.getElementById('u368');

var u369 = document.getElementById('u369');
gv_vAlignTable['u369'] = 'center';
var u370 = document.getElementById('u370');
gv_vAlignTable['u370'] = 'top';
var u371 = document.getElementById('u371');
gv_vAlignTable['u371'] = 'top';
var u372 = document.getElementById('u372');
gv_vAlignTable['u372'] = 'top';
var u373 = document.getElementById('u373');
gv_vAlignTable['u373'] = 'top';
var u374 = document.getElementById('u374');
gv_vAlignTable['u374'] = 'top';
var u375 = document.getElementById('u375');

var u376 = document.getElementById('u376');

if (bIE) u376.attachEvent("onblur", LostFocusu376);
else u376.addEventListener("blur", LostFocusu376, true);
function LostFocusu376(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u377', '' + (GetWidgetFormText('u375') * GetWidgetFormText('u376')) + '');

SetWidgetFormText('u379', '' + (GetNum(GetWidgetFormText('u377')) + GetNum(GetWidgetFormText('u383'))) + '');

}

}

var u377 = document.getElementById('u377');

var u378 = document.getElementById('u378');
gv_vAlignTable['u378'] = 'top';
var u379 = document.getElementById('u379');

var u380 = document.getElementById('u380');

var u381 = document.getElementById('u381');

var u382 = document.getElementById('u382');

if (bIE) u382.attachEvent("onblur", LostFocusu382);
else u382.addEventListener("blur", LostFocusu382, true);
function LostFocusu382(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u383', '' + (GetWidgetFormText('u381') * GetWidgetFormText('u382')) + '');

}

}

var u383 = document.getElementById('u383');

var u384 = document.getElementById('u384');
gv_vAlignTable['u384'] = 'top';
var u385 = document.getElementById('u385');
gv_vAlignTable['u385'] = 'top';
var u386 = document.getElementById('u386');
gv_vAlignTable['u386'] = 'top';
var u387 = document.getElementById('u387');
gv_vAlignTable['u387'] = 'top';
var u388 = document.getElementById('u388');
gv_vAlignTable['u388'] = 'top';
var u389 = document.getElementById('u389');

var u200 = document.getElementById('u200');

var u201 = document.getElementById('u201');
gv_vAlignTable['u201'] = 'center';
var u202 = document.getElementById('u202');
gv_vAlignTable['u202'] = 'top';
var u390 = document.getElementById('u390');

var u391 = document.getElementById('u391');

var u205 = document.getElementById('u205');

var u393 = document.getElementById('u393');
gv_vAlignTable['u393'] = 'top';
var u394 = document.getElementById('u394');

var u395 = document.getElementById('u395');

var u396 = document.getElementById('u396');
gv_vAlignTable['u396'] = 'center';
var u397 = document.getElementById('u397');
gv_vAlignTable['u397'] = 'top';
var u398 = document.getElementById('u398');
gv_vAlignTable['u398'] = 'top';
var u399 = document.getElementById('u399');
gv_vAlignTable['u399'] = 'top';
var u210 = document.getElementById('u210');

if (bIE) u210.attachEvent("onblur", LostFocusu210);
else u210.addEventListener("blur", LostFocusu210, true);
function LostFocusu210(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u211', '' + (GetWidgetFormText('u209') * GetWidgetFormText('u210')) + '');

}

}

var u211 = document.getElementById('u211');

var u212 = document.getElementById('u212');
gv_vAlignTable['u212'] = 'top';
var u213 = document.getElementById('u213');
gv_vAlignTable['u213'] = 'top';
var u214 = document.getElementById('u214');
gv_vAlignTable['u214'] = 'top';
var u215 = document.getElementById('u215');
gv_vAlignTable['u215'] = 'top';
var u216 = document.getElementById('u216');
gv_vAlignTable['u216'] = 'top';
var u217 = document.getElementById('u217');

var u218 = document.getElementById('u218');

var u219 = document.getElementById('u219');

var u220 = document.getElementById('u220');

u220.style.cursor = 'pointer';
if (bIE) u220.attachEvent("onclick", Clicku220);
else u220.addEventListener("click", Clicku220, true);
function Clicku220(e)
{
windowEvent = e;


if ((GetCheckState('u220')) == (true)) {

	MoveWidgetBy('u96',0,50,'swing',500);

	MoveWidgetBy('u137',0,50,'swing',500);

	SetPanelVisibility('u43','','fade',500);

}
else
if ((GetCheckState('u220')) == (false)) {

	SetPanelVisibility('u43','hidden','none',500);

	SetPanelVisibility('u56','hidden','none',500);

	MoveWidgetBy('u96',0,-50,'swing',500);

	MoveWidgetBy('u137',0,-50,'swing',500);

}

}

var u221 = document.getElementById('u221');
gv_vAlignTable['u221'] = 'top';
var u222 = document.getElementById('u222');
gv_vAlignTable['u222'] = 'top';
var u223 = document.getElementById('u223');
gv_vAlignTable['u223'] = 'top';
var u224 = document.getElementById('u224');
gv_vAlignTable['u224'] = 'top';
var u225 = document.getElementById('u225');
gv_vAlignTable['u225'] = 'top';
var u226 = document.getElementById('u226');
gv_vAlignTable['u226'] = 'top';
var u227 = document.getElementById('u227');

var u228 = document.getElementById('u228');

if (bIE) u228.attachEvent("onblur", LostFocusu228);
else u228.addEventListener("blur", LostFocusu228, true);
function LostFocusu228(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u229', '' + (GetWidgetFormText('u227') * GetWidgetFormText('u228')) + '');

SetWidgetFormText('u231', '' + (GetNum(GetWidgetFormText('u229')) + GetNum(GetWidgetFormText('u235'))) + '');

}

}

var u229 = document.getElementById('u229');

var u230 = document.getElementById('u230');
gv_vAlignTable['u230'] = 'top';
var u231 = document.getElementById('u231');

var u232 = document.getElementById('u232');

var u233 = document.getElementById('u233');

var u234 = document.getElementById('u234');

if (bIE) u234.attachEvent("onblur", LostFocusu234);
else u234.addEventListener("blur", LostFocusu234, true);
function LostFocusu234(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u235', '' + (GetWidgetFormText('u233') * GetWidgetFormText('u234')) + '');

}

}

var u235 = document.getElementById('u235');

var u236 = document.getElementById('u236');
gv_vAlignTable['u236'] = 'top';
var u237 = document.getElementById('u237');
gv_vAlignTable['u237'] = 'top';
var u238 = document.getElementById('u238');
gv_vAlignTable['u238'] = 'top';
var u239 = document.getElementById('u239');
gv_vAlignTable['u239'] = 'top';
var u240 = document.getElementById('u240');
gv_vAlignTable['u240'] = 'top';
var u241 = document.getElementById('u241');

var u242 = document.getElementById('u242');

var u243 = document.getElementById('u243');

var u244 = document.getElementById('u244');

u244.style.cursor = 'pointer';
if (bIE) u244.attachEvent("onclick", Clicku244);
else u244.addEventListener("click", Clicku244, true);
function Clicku244(e)
{
windowEvent = e;


if ((GetCheckState('u244')) == (true)) {

	MoveWidgetBy('u96',0,50,'swing',500);

	MoveWidgetBy('u137',0,50,'swing',500);

	SetPanelVisibility('u43','','fade',500);

}
else
if ((GetCheckState('u244')) == (false)) {

	SetPanelVisibility('u43','hidden','none',500);

	SetPanelVisibility('u56','hidden','none',500);

	MoveWidgetBy('u96',0,-50,'swing',500);

	MoveWidgetBy('u137',0,-50,'swing',500);

}

}

var u245 = document.getElementById('u245');
gv_vAlignTable['u245'] = 'top';
var u246 = document.getElementById('u246');
gv_vAlignTable['u246'] = 'top';
var u247 = document.getElementById('u247');
gv_vAlignTable['u247'] = 'top';
var u248 = document.getElementById('u248');
gv_vAlignTable['u248'] = 'top';
var u249 = document.getElementById('u249');
gv_vAlignTable['u249'] = 'top';
var u250 = document.getElementById('u250');
gv_vAlignTable['u250'] = 'top';
var u251 = document.getElementById('u251');

var u252 = document.getElementById('u252');

if (bIE) u252.attachEvent("onblur", LostFocusu252);
else u252.addEventListener("blur", LostFocusu252, true);
function LostFocusu252(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u253', '' + (GetWidgetFormText('u251') * GetWidgetFormText('u252')) + '');

SetWidgetFormText('u255', '' + (GetNum(GetWidgetFormText('u253')) + GetNum(GetWidgetFormText('u259'))) + '');

}

}

var u253 = document.getElementById('u253');

var u254 = document.getElementById('u254');
gv_vAlignTable['u254'] = 'top';
var u255 = document.getElementById('u255');

var u256 = document.getElementById('u256');

var u257 = document.getElementById('u257');

var u258 = document.getElementById('u258');

if (bIE) u258.attachEvent("onblur", LostFocusu258);
else u258.addEventListener("blur", LostFocusu258, true);
function LostFocusu258(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u259', '' + (GetWidgetFormText('u257') * GetWidgetFormText('u258')) + '');

}

}

var u259 = document.getElementById('u259');

var u0 = document.getElementById('u0');

var u1 = document.getElementById('u1');
gv_vAlignTable['u1'] = 'center';
var u2 = document.getElementById('u2');

var u3 = document.getElementById('u3');
gv_vAlignTable['u3'] = 'center';
var u4 = document.getElementById('u4');
gv_vAlignTable['u4'] = 'top';
var u5 = document.getElementById('u5');
gv_vAlignTable['u5'] = 'top';
var u6 = document.getElementById('u6');
gv_vAlignTable['u6'] = 'top';
var u7 = document.getElementById('u7');
gv_vAlignTable['u7'] = 'top';
var u8 = document.getElementById('u8');
gv_vAlignTable['u8'] = 'top';
var u260 = document.getElementById('u260');
gv_vAlignTable['u260'] = 'top';
var u261 = document.getElementById('u261');
gv_vAlignTable['u261'] = 'top';
var u262 = document.getElementById('u262');
gv_vAlignTable['u262'] = 'top';
var u263 = document.getElementById('u263');
gv_vAlignTable['u263'] = 'top';
var u264 = document.getElementById('u264');
gv_vAlignTable['u264'] = 'top';
var u265 = document.getElementById('u265');

var u266 = document.getElementById('u266');

var u267 = document.getElementById('u267');

var u268 = document.getElementById('u268');

u268.style.cursor = 'pointer';
if (bIE) u268.attachEvent("onclick", Clicku268);
else u268.addEventListener("click", Clicku268, true);
function Clicku268(e)
{
windowEvent = e;


if ((GetCheckState('u268')) == (true)) {

	MoveWidgetBy('u96',0,50,'swing',500);

	MoveWidgetBy('u137',0,50,'swing',500);

	SetPanelVisibility('u43','','fade',500);

}
else
if ((GetCheckState('u268')) == (false)) {

	SetPanelVisibility('u43','hidden','none',500);

	SetPanelVisibility('u56','hidden','none',500);

	MoveWidgetBy('u96',0,-50,'swing',500);

	MoveWidgetBy('u137',0,-50,'swing',500);

}

}

var u269 = document.getElementById('u269');
gv_vAlignTable['u269'] = 'top';
if (window.OnLoad) OnLoad();
