
var PageName = '-';
var PageId = '4413f7322e7a4f93bf3f730f70c3fb91'
var PageUrl = '-.html'
document.title = '-';
var PageNotes = 
{
"pageName":"-",
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

var u271 = document.getElementById('u271');

if (bIE) u271.attachEvent("onblur", LostFocusu271);
else u271.addEventListener("blur", LostFocusu271, true);
function LostFocusu271(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u272', '' + (GetWidgetFormText('u270') * GetWidgetFormText('u271')) + '');

}

}

var u272 = document.getElementById('u272');

var u273 = document.getElementById('u273');
gv_vAlignTable['u273'] = 'top';
var u274 = document.getElementById('u274');
gv_vAlignTable['u274'] = 'top';
var u275 = document.getElementById('u275');
gv_vAlignTable['u275'] = 'top';
var u276 = document.getElementById('u276');
gv_vAlignTable['u276'] = 'top';
var u277 = document.getElementById('u277');
gv_vAlignTable['u277'] = 'top';
var u278 = document.getElementById('u278');

var u279 = document.getElementById('u279');

var u280 = document.getElementById('u280');

var u281 = document.getElementById('u281');

u281.style.cursor = 'pointer';
if (bIE) u281.attachEvent("onclick", Clicku281);
else u281.addEventListener("click", Clicku281, true);
function Clicku281(e)
{
windowEvent = e;


if ((GetCheckState('u281')) == (true)) {

	MoveWidgetBy('u106',0,50,'swing',500);

	MoveWidgetBy('u147',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u281')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u106',0,-50,'swing',500);

	MoveWidgetBy('u147',0,-50,'swing',500);

}

}

var u282 = document.getElementById('u282');
gv_vAlignTable['u282'] = 'top';
var u283 = document.getElementById('u283');

var u284 = document.getElementById('u284');

var u285 = document.getElementById('u285');

var u286 = document.getElementById('u286');

var u287 = document.getElementById('u287');

var u288 = document.getElementById('u288');
gv_vAlignTable['u288'] = 'center';
var u289 = document.getElementById('u289');
gv_vAlignTable['u289'] = 'top';
var u490 = document.getElementById('u490');
gv_vAlignTable['u490'] = 'top';
var u491 = document.getElementById('u491');

var u492 = document.getElementById('u492');

var u493 = document.getElementById('u493');

var u494 = document.getElementById('u494');

u494.style.cursor = 'pointer';
if (bIE) u494.attachEvent("onclick", Clicku494);
else u494.addEventListener("click", Clicku494, true);
function Clicku494(e)
{
windowEvent = e;


if ((GetCheckState('u494')) == (true)) {

	MoveWidgetBy('u106',0,50,'swing',500);

	MoveWidgetBy('u147',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u494')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u106',0,-50,'swing',500);

	MoveWidgetBy('u147',0,-50,'swing',500);

}

}

var u495 = document.getElementById('u495');
gv_vAlignTable['u495'] = 'top';
var u496 = document.getElementById('u496');
gv_vAlignTable['u496'] = 'top';
var u100 = document.getElementById('u100');

var u101 = document.getElementById('u101');

u101.style.cursor = 'pointer';
if (bIE) u101.attachEvent("onclick", Clicku101);
else u101.addEventListener("click", Clicku101, true);
function Clicku101(e)
{
windowEvent = e;


if ((GetCheckState('u101')) == (true)) {

	MoveWidgetBy('u106',0,50,'swing',500);

	MoveWidgetBy('u147',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u101')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u106',0,-50,'swing',500);

	MoveWidgetBy('u147',0,-50,'swing',500);

}

}

var u102 = document.getElementById('u102');
gv_vAlignTable['u102'] = 'top';
var u103 = document.getElementById('u103');

var u104 = document.getElementById('u104');
gv_vAlignTable['u104'] = 'top';
var u105 = document.getElementById('u105');

var u106 = document.getElementById('u106');

var u107 = document.getElementById('u107');

var u108 = document.getElementById('u108');

var u109 = document.getElementById('u109');

var u297 = document.getElementById('u297');

var u298 = document.getElementById('u298');
gv_vAlignTable['u298'] = 'center';
var u299 = document.getElementById('u299');

var u500 = document.getElementById('u500');
gv_vAlignTable['u500'] = 'top';
var u392 = document.getElementById('u392');

if (bIE) u392.attachEvent("onblur", LostFocusu392);
else u392.addEventListener("blur", LostFocusu392, true);
function LostFocusu392(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u393', '' + (GetWidgetFormText('u391') * GetWidgetFormText('u392')) + '');

SetWidgetFormText('u395', '' + (GetNum(GetWidgetFormText('u393')) + GetNum(GetWidgetFormText('u399'))) + '');

}

}

var u9 = document.getElementById('u9');
gv_vAlignTable['u9'] = 'top';
var u110 = document.getElementById('u110');

var u111 = document.getElementById('u111');

if (bIE) u111.attachEvent("onblur", LostFocusu111);
else u111.addEventListener("blur", LostFocusu111, true);
function LostFocusu111(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u112', '' + (GetWidgetFormText('u109') * GetWidgetFormText('u111')) + '');

}

}

var u112 = document.getElementById('u112');

var u113 = document.getElementById('u113');
gv_vAlignTable['u113'] = 'top';
var u114 = document.getElementById('u114');
gv_vAlignTable['u114'] = 'top';
var u115 = document.getElementById('u115');
gv_vAlignTable['u115'] = 'top';
var u116 = document.getElementById('u116');
gv_vAlignTable['u116'] = 'top';
var u117 = document.getElementById('u117');
gv_vAlignTable['u117'] = 'top';
var u118 = document.getElementById('u118');

var u119 = document.getElementById('u119');

u119.style.cursor = 'pointer';
if (bIE) u119.attachEvent("onclick", Clicku119);
else u119.addEventListener("click", Clicku119, true);
function Clicku119(e)
{
windowEvent = e;


if (true) {

	MoveWidgetBy('u147',0,50,'swing',500);

	SetPanelVisibility('u107','hidden','none',500);

	SetPanelVisibility('u122','','fade',500);

}

}
gv_vAlignTable['u119'] = 'top';
var u510 = document.getElementById('u510');
gv_vAlignTable['u510'] = 'top';
var u32 = document.getElementById('u32');
gv_vAlignTable['u32'] = 'center';
var u33 = document.getElementById('u33');

var u34 = document.getElementById('u34');
gv_vAlignTable['u34'] = 'center';
var u35 = document.getElementById('u35');

var u120 = document.getElementById('u120');

u120.style.cursor = 'pointer';
if (bIE) u120.attachEvent("onclick", Clicku120);
else u120.addEventListener("click", Clicku120, true);
function Clicku120(e)
{
windowEvent = e;


if ((GetCheckState('u120')) == (true)) {

	MoveWidgetBy('u147',0,50,'swing',500);

	SetPanelVisibility('u107','','fade',500);

}
else
if ((GetCheckState('u120')) == (false)) {

	SetPanelVisibility('u107','hidden','none',500);

	SetPanelVisibility('u122','hidden','none',500);

	MoveWidgetBy('u147',0,-50,'swing',500);

}

}

var u121 = document.getElementById('u121');
gv_vAlignTable['u121'] = 'top';
var u122 = document.getElementById('u122');

var u123 = document.getElementById('u123');

var u124 = document.getElementById('u124');

var u125 = document.getElementById('u125');

var u126 = document.getElementById('u126');

if (bIE) u126.attachEvent("onblur", LostFocusu126);
else u126.addEventListener("blur", LostFocusu126, true);
function LostFocusu126(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u127', '' + (GetWidgetFormText('u124') * GetWidgetFormText('u126')) + '');

}

}

var u127 = document.getElementById('u127');

var u128 = document.getElementById('u128');
gv_vAlignTable['u128'] = 'top';
var u129 = document.getElementById('u129');
gv_vAlignTable['u129'] = 'top';
var u130 = document.getElementById('u130');
gv_vAlignTable['u130'] = 'top';
var u131 = document.getElementById('u131');
gv_vAlignTable['u131'] = 'top';
var u132 = document.getElementById('u132');
gv_vAlignTable['u132'] = 'top';
var u133 = document.getElementById('u133');

var u134 = document.getElementById('u134');

var u135 = document.getElementById('u135');

var u136 = document.getElementById('u136');

var u137 = document.getElementById('u137');

if (bIE) u137.attachEvent("onblur", LostFocusu137);
else u137.addEventListener("blur", LostFocusu137, true);
function LostFocusu137(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u138', '' + (GetWidgetFormText('u135') * GetWidgetFormText('u137')) + '');

}

}

var u138 = document.getElementById('u138');

var u139 = document.getElementById('u139');
gv_vAlignTable['u139'] = 'top';
var u140 = document.getElementById('u140');
gv_vAlignTable['u140'] = 'top';
var u141 = document.getElementById('u141');
gv_vAlignTable['u141'] = 'top';
var u142 = document.getElementById('u142');
gv_vAlignTable['u142'] = 'top';
var u143 = document.getElementById('u143');
gv_vAlignTable['u143'] = 'top';
var u144 = document.getElementById('u144');

var u145 = document.getElementById('u145');

u145.style.cursor = 'pointer';
if (bIE) u145.attachEvent("onclick", Clicku145);
else u145.addEventListener("click", Clicku145, true);
function Clicku145(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u122','hidden','none',500);

	SetPanelVisibility('u107','','none',500);

	MoveWidgetBy('u147',0,-50,'swing',500);

}

}
gv_vAlignTable['u145'] = 'top';
var u146 = document.getElementById('u146');
gv_vAlignTable['u146'] = 'top';
var u147 = document.getElementById('u147');

var u148 = document.getElementById('u148');

var u149 = document.getElementById('u149');

var u501 = document.getElementById('u501');

var u502 = document.getElementById('u502');

if (bIE) u502.attachEvent("onblur", LostFocusu502);
else u502.addEventListener("blur", LostFocusu502, true);
function LostFocusu502(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u503', '' + (GetWidgetFormText('u501') * GetWidgetFormText('u502')) + '');

SetWidgetFormText('u505', '' + (GetNum(GetWidgetFormText('u503')) + GetNum(GetWidgetFormText('u509'))) + '');

}

}

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

var u151 = document.getElementById('u151');

var u152 = document.getElementById('u152');

if (bIE) u152.attachEvent("onblur", LostFocusu152);
else u152.addEventListener("blur", LostFocusu152, true);
function LostFocusu152(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u153', '' + (GetWidgetFormText('u150') * GetWidgetFormText('u152')) + '');

}

}

var u153 = document.getElementById('u153');

var u154 = document.getElementById('u154');
gv_vAlignTable['u154'] = 'top';
var u155 = document.getElementById('u155');
gv_vAlignTable['u155'] = 'top';
var u156 = document.getElementById('u156');
gv_vAlignTable['u156'] = 'top';
var u157 = document.getElementById('u157');
gv_vAlignTable['u157'] = 'top';
var u158 = document.getElementById('u158');
gv_vAlignTable['u158'] = 'top';
var u159 = document.getElementById('u159');

var u511 = document.getElementById('u511');
gv_vAlignTable['u511'] = 'top';
var u512 = document.getElementById('u512');
gv_vAlignTable['u512'] = 'top';
var u513 = document.getElementById('u513');
gv_vAlignTable['u513'] = 'top';
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

	MoveWidgetBy('u106',0,50,'swing',500);

	MoveWidgetBy('u147',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u28')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u106',0,-50,'swing',500);

	MoveWidgetBy('u147',0,-50,'swing',500);

}

}

var u29 = document.getElementById('u29');
gv_vAlignTable['u29'] = 'top';
var u160 = document.getElementById('u160');

u160.style.cursor = 'pointer';
if (bIE) u160.attachEvent("onclick", Clicku160);
else u160.addEventListener("click", Clicku160, true);
function Clicku160(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u148','hidden','none',500);

	SetPanelVisibility('u163','','fade',500);

}

}
gv_vAlignTable['u160'] = 'top';
var u161 = document.getElementById('u161');

u161.style.cursor = 'pointer';
if (bIE) u161.attachEvent("onclick", Clicku161);
else u161.addEventListener("click", Clicku161, true);
function Clicku161(e)
{
windowEvent = e;


if ((GetCheckState('u161')) == (true)) {

	SetPanelVisibility('u148','','fade',500);

}
else
if ((GetCheckState('u161')) == (false)) {

	SetPanelVisibility('u148','hidden','none',500);

	SetPanelVisibility('u163','hidden','none',500);

}

}

var u162 = document.getElementById('u162');
gv_vAlignTable['u162'] = 'top';
var u163 = document.getElementById('u163');

var u164 = document.getElementById('u164');

var u165 = document.getElementById('u165');

var u166 = document.getElementById('u166');

var u167 = document.getElementById('u167');

if (bIE) u167.attachEvent("onblur", LostFocusu167);
else u167.addEventListener("blur", LostFocusu167, true);
function LostFocusu167(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u168', '' + (GetWidgetFormText('u165') * GetWidgetFormText('u167')) + '');

}

}

var u168 = document.getElementById('u168');

var u169 = document.getElementById('u169');
gv_vAlignTable['u169'] = 'top';
var u521 = document.getElementById('u521');

var u522 = document.getElementById('u522');
gv_vAlignTable['u522'] = 'center';
var u203 = document.getElementById('u203');
gv_vAlignTable['u203'] = 'center';
var u30 = document.getElementById('u30');

var u31 = document.getElementById('u31');

var u206 = document.getElementById('u206');

u206.style.cursor = 'pointer';
if (bIE) u206.attachEvent("onclick", Clicku206);
else u206.addEventListener("click", Clicku206, true);
function Clicku206(e)
{
windowEvent = e;


if (true) {

	self.location.href="passo-3-portfolio-empresa.html" + GetQuerystring();

}

}

var u207 = document.getElementById('u207');
gv_vAlignTable['u207'] = 'center';
var u208 = document.getElementById('u208');

var u209 = document.getElementById('u209');
gv_vAlignTable['u209'] = 'center';
var u36 = document.getElementById('u36');
gv_vAlignTable['u36'] = 'center';
var u37 = document.getElementById('u37');

var u38 = document.getElementById('u38');

var u39 = document.getElementById('u39');
gv_vAlignTable['u39'] = 'center';
var u170 = document.getElementById('u170');
gv_vAlignTable['u170'] = 'top';
var u171 = document.getElementById('u171');
gv_vAlignTable['u171'] = 'top';
var u172 = document.getElementById('u172');
gv_vAlignTable['u172'] = 'top';
var u173 = document.getElementById('u173');
gv_vAlignTable['u173'] = 'top';
var u174 = document.getElementById('u174');

var u175 = document.getElementById('u175');

var u176 = document.getElementById('u176');

var u177 = document.getElementById('u177');

var u178 = document.getElementById('u178');

if (bIE) u178.attachEvent("onblur", LostFocusu178);
else u178.addEventListener("blur", LostFocusu178, true);
function LostFocusu178(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u179', '' + (GetWidgetFormText('u176') * GetWidgetFormText('u178')) + '');

}

}

var u179 = document.getElementById('u179');

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
gv_vAlignTable['u180'] = 'top';
var u181 = document.getElementById('u181');
gv_vAlignTable['u181'] = 'top';
var u182 = document.getElementById('u182');
gv_vAlignTable['u182'] = 'top';
var u183 = document.getElementById('u183');
gv_vAlignTable['u183'] = 'top';
var u184 = document.getElementById('u184');
gv_vAlignTable['u184'] = 'top';
var u185 = document.getElementById('u185');

var u186 = document.getElementById('u186');

u186.style.cursor = 'pointer';
if (bIE) u186.attachEvent("onclick", Clicku186);
else u186.addEventListener("click", Clicku186, true);
function Clicku186(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u163','hidden','none',500);

	SetPanelVisibility('u148','','none',500);

}

}
gv_vAlignTable['u186'] = 'top';
var u187 = document.getElementById('u187');
gv_vAlignTable['u187'] = 'top';
var u188 = document.getElementById('u188');

var u189 = document.getElementById('u189');

u189.style.cursor = 'pointer';
if (bIE) u189.attachEvent("onclick", Clicku189);
else u189.addEventListener("click", Clicku189, true);
function Clicku189(e)
{
windowEvent = e;


if (true) {

	self.location.href="passo-1-dados-projeto-pj.html" + GetQuerystring();

}

}

var u541 = document.getElementById('u541');

var u542 = document.getElementById('u542');

if (bIE) u542.attachEvent("onblur", LostFocusu542);
else u542.addEventListener("blur", LostFocusu542, true);
function LostFocusu542(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u543', '' + (GetWidgetFormText('u541') * GetWidgetFormText('u542')) + '');

}

}

var u543 = document.getElementById('u543');

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

	MoveWidgetBy('u106',0,60,'swing',500);

	MoveWidgetBy('u147',0,60,'swing',500);

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

	MoveWidgetBy('u106',0,-60,'swing',500);

	MoveWidgetBy('u147',0,-60,'swing',500);

}

}
gv_vAlignTable['u59'] = 'top';
var u190 = document.getElementById('u190');
gv_vAlignTable['u190'] = 'center';
var u191 = document.getElementById('u191');

u191.style.cursor = 'pointer';
if (bIE) u191.attachEvent("onclick", Clicku191);
else u191.addEventListener("click", Clicku191, true);
function Clicku191(e)
{
windowEvent = e;


if (true) {

	self.location.href="passo-2.2-dados-diretor-pj.html" + GetQuerystring();

}

}

var u192 = document.getElementById('u192');
gv_vAlignTable['u192'] = 'center';
var u193 = document.getElementById('u193');

u193.style.cursor = 'pointer';
if (bIE) u193.attachEvent("onclick", Clicku193);
else u193.addEventListener("click", Clicku193, true);
function Clicku193(e)
{
windowEvent = e;


if (true) {

	self.location.href="passo-3-portfolio-empresa.html" + GetQuerystring();

}

}

var u194 = document.getElementById('u194');
gv_vAlignTable['u194'] = 'center';
var u195 = document.getElementById('u195');
gv_vAlignTable['u195'] = 'top';
var u196 = document.getElementById('u196');
gv_vAlignTable['u196'] = 'top';
var u197 = document.getElementById('u197');
gv_vAlignTable['u197'] = 'top';
var u198 = document.getElementById('u198');

var u199 = document.getElementById('u199');

var u551 = document.getElementById('u551');

var u552 = document.getElementById('u552');

u552.style.cursor = 'pointer';
if (bIE) u552.attachEvent("onclick", Clicku552);
else u552.addEventListener("click", Clicku552, true);
function Clicku552(e)
{
windowEvent = e;


if ((GetCheckState('u552')) == (true)) {

	MoveWidgetBy('u106',0,50,'swing',500);

	MoveWidgetBy('u147',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u552')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u106',0,-50,'swing',500);

	MoveWidgetBy('u147',0,-50,'swing',500);

}

}

var u553 = document.getElementById('u553');
gv_vAlignTable['u553'] = 'top';
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

var u562 = document.getElementById('u562');

var u563 = document.getElementById('u563');
gv_vAlignTable['u563'] = 'center';
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
var u570 = document.getElementById('u570');

var u571 = document.getElementById('u571');
gv_vAlignTable['u571'] = 'center';
var u572 = document.getElementById('u572');
gv_vAlignTable['u572'] = 'top';
var u573 = document.getElementById('u573');
gv_vAlignTable['u573'] = 'top';
var u80 = document.getElementById('u80');
gv_vAlignTable['u80'] = 'top';
var u81 = document.getElementById('u81');

var u82 = document.getElementById('u82');

var u83 = document.getElementById('u83');

var u84 = document.getElementById('u84');
gv_vAlignTable['u84'] = 'top';
var u85 = document.getElementById('u85');
gv_vAlignTable['u85'] = 'top';
var u86 = document.getElementById('u86');
gv_vAlignTable['u86'] = 'top';
var u87 = document.getElementById('u87');
gv_vAlignTable['u87'] = 'top';
var u88 = document.getElementById('u88');
gv_vAlignTable['u88'] = 'top';
var u89 = document.getElementById('u89');

var u580 = document.getElementById('u580');

var u581 = document.getElementById('u581');
gv_vAlignTable['u581'] = 'center';
var u90 = document.getElementById('u90');
gv_vAlignTable['u90'] = 'top';
var u91 = document.getElementById('u91');

var u92 = document.getElementById('u92');

var u93 = document.getElementById('u93');
gv_vAlignTable['u93'] = 'center';
var u94 = document.getElementById('u94');

var u95 = document.getElementById('u95');
gv_vAlignTable['u95'] = 'center';
var u96 = document.getElementById('u96');
gv_vAlignTable['u96'] = 'top';
var u97 = document.getElementById('u97');
gv_vAlignTable['u97'] = 'top';
var u98 = document.getElementById('u98');
gv_vAlignTable['u98'] = 'top';
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
gv_vAlignTable['u404'] = 'top';
var u405 = document.getElementById('u405');

var u406 = document.getElementById('u406');

var u407 = document.getElementById('u407');

var u408 = document.getElementById('u408');

u408.style.cursor = 'pointer';
if (bIE) u408.attachEvent("onclick", Clicku408);
else u408.addEventListener("click", Clicku408, true);
function Clicku408(e)
{
windowEvent = e;


if ((GetCheckState('u408')) == (true)) {

	MoveWidgetBy('u106',0,50,'swing',500);

	MoveWidgetBy('u147',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u408')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u106',0,-50,'swing',500);

	MoveWidgetBy('u147',0,-50,'swing',500);

}

}

var u409 = document.getElementById('u409');
gv_vAlignTable['u409'] = 'top';
var u410 = document.getElementById('u410');

var u411 = document.getElementById('u411');

var u412 = document.getElementById('u412');
gv_vAlignTable['u412'] = 'center';
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

if (bIE) u419.attachEvent("onblur", LostFocusu419);
else u419.addEventListener("blur", LostFocusu419, true);
function LostFocusu419(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u420', '' + (GetWidgetFormText('u418') * GetWidgetFormText('u419')) + '');

SetWidgetFormText('u422', '' + (GetNum(GetWidgetFormText('u420')) + GetNum(GetWidgetFormText('u426'))) + '');

}

}

var u420 = document.getElementById('u420');

var u421 = document.getElementById('u421');
gv_vAlignTable['u421'] = 'top';
var u422 = document.getElementById('u422');

var u423 = document.getElementById('u423');

var u424 = document.getElementById('u424');

var u425 = document.getElementById('u425');

if (bIE) u425.attachEvent("onblur", LostFocusu425);
else u425.addEventListener("blur", LostFocusu425, true);
function LostFocusu425(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u426', '' + (GetWidgetFormText('u424') * GetWidgetFormText('u425')) + '');

}

}

var u426 = document.getElementById('u426');

var u427 = document.getElementById('u427');
gv_vAlignTable['u427'] = 'top';
var u428 = document.getElementById('u428');
gv_vAlignTable['u428'] = 'top';
var u429 = document.getElementById('u429');
gv_vAlignTable['u429'] = 'top';
var u290 = document.getElementById('u290');
gv_vAlignTable['u290'] = 'top';
var u291 = document.getElementById('u291');
gv_vAlignTable['u291'] = 'top';
var u292 = document.getElementById('u292');

var u293 = document.getElementById('u293');

var u294 = document.getElementById('u294');
gv_vAlignTable['u294'] = 'center';
var u295 = document.getElementById('u295');
gv_vAlignTable['u295'] = 'top';
var u296 = document.getElementById('u296');

var u430 = document.getElementById('u430');
gv_vAlignTable['u430'] = 'top';
var u431 = document.getElementById('u431');
gv_vAlignTable['u431'] = 'top';
var u432 = document.getElementById('u432');

var u433 = document.getElementById('u433');

var u434 = document.getElementById('u434');

var u435 = document.getElementById('u435');

u435.style.cursor = 'pointer';
if (bIE) u435.attachEvent("onclick", Clicku435);
else u435.addEventListener("click", Clicku435, true);
function Clicku435(e)
{
windowEvent = e;


if ((GetCheckState('u435')) == (true)) {

	MoveWidgetBy('u106',0,50,'swing',500);

	MoveWidgetBy('u147',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u435')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u106',0,-50,'swing',500);

	MoveWidgetBy('u147',0,-50,'swing',500);

}

}

var u436 = document.getElementById('u436');
gv_vAlignTable['u436'] = 'top';
var u437 = document.getElementById('u437');

var u438 = document.getElementById('u438');

var u439 = document.getElementById('u439');
gv_vAlignTable['u439'] = 'center';
var u440 = document.getElementById('u440');
gv_vAlignTable['u440'] = 'top';
var u441 = document.getElementById('u441');

var u442 = document.getElementById('u442');
gv_vAlignTable['u442'] = 'center';
var u443 = document.getElementById('u443');

var u444 = document.getElementById('u444');
gv_vAlignTable['u444'] = 'center';
var u445 = document.getElementById('u445');

var u446 = document.getElementById('u446');

var u447 = document.getElementById('u447');
gv_vAlignTable['u447'] = 'center';
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

if (bIE) u454.attachEvent("onblur", LostFocusu454);
else u454.addEventListener("blur", LostFocusu454, true);
function LostFocusu454(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u455', '' + (GetWidgetFormText('u453') * GetWidgetFormText('u454')) + '');

SetWidgetFormText('u457', '' + (GetNum(GetWidgetFormText('u455')) + GetNum(GetWidgetFormText('u461'))) + '');

}

}

var u455 = document.getElementById('u455');

var u456 = document.getElementById('u456');
gv_vAlignTable['u456'] = 'top';
var u457 = document.getElementById('u457');

var u458 = document.getElementById('u458');

var u459 = document.getElementById('u459');

var u460 = document.getElementById('u460');

if (bIE) u460.attachEvent("onblur", LostFocusu460);
else u460.addEventListener("blur", LostFocusu460, true);
function LostFocusu460(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u461', '' + (GetWidgetFormText('u459') * GetWidgetFormText('u460')) + '');

}

}

var u461 = document.getElementById('u461');

var u462 = document.getElementById('u462');
gv_vAlignTable['u462'] = 'top';
var u463 = document.getElementById('u463');
gv_vAlignTable['u463'] = 'top';
var u464 = document.getElementById('u464');
gv_vAlignTable['u464'] = 'top';
var u465 = document.getElementById('u465');
gv_vAlignTable['u465'] = 'top';
var u466 = document.getElementById('u466');
gv_vAlignTable['u466'] = 'top';
var u467 = document.getElementById('u467');

var u468 = document.getElementById('u468');

var u469 = document.getElementById('u469');

var u470 = document.getElementById('u470');

u470.style.cursor = 'pointer';
if (bIE) u470.attachEvent("onclick", Clicku470);
else u470.addEventListener("click", Clicku470, true);
function Clicku470(e)
{
windowEvent = e;


if ((GetCheckState('u470')) == (true)) {

	MoveWidgetBy('u106',0,50,'swing',500);

	MoveWidgetBy('u147',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u470')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u106',0,-50,'swing',500);

	MoveWidgetBy('u147',0,-50,'swing',500);

}

}

var u471 = document.getElementById('u471');
gv_vAlignTable['u471'] = 'top';
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

if (bIE) u478.attachEvent("onblur", LostFocusu478);
else u478.addEventListener("blur", LostFocusu478, true);
function LostFocusu478(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u479', '' + (GetWidgetFormText('u477') * GetWidgetFormText('u478')) + '');

SetWidgetFormText('u481', '' + (GetNum(GetWidgetFormText('u479')) + GetNum(GetWidgetFormText('u485'))) + '');

}

}

var u479 = document.getElementById('u479');

var u480 = document.getElementById('u480');
gv_vAlignTable['u480'] = 'top';
var u481 = document.getElementById('u481');

var u482 = document.getElementById('u482');

var u483 = document.getElementById('u483');

var u484 = document.getElementById('u484');

if (bIE) u484.attachEvent("onblur", LostFocusu484);
else u484.addEventListener("blur", LostFocusu484, true);
function LostFocusu484(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u485', '' + (GetWidgetFormText('u483') * GetWidgetFormText('u484')) + '');

}

}

var u485 = document.getElementById('u485');

var u486 = document.getElementById('u486');
gv_vAlignTable['u486'] = 'top';
var u487 = document.getElementById('u487');
gv_vAlignTable['u487'] = 'top';
var u488 = document.getElementById('u488');
gv_vAlignTable['u488'] = 'top';
var u489 = document.getElementById('u489');
gv_vAlignTable['u489'] = 'top';
var u204 = document.getElementById('u204');

u204.style.cursor = 'pointer';
if (bIE) u204.attachEvent("onclick", Clicku204);
else u204.addEventListener("click", Clicku204, true);
function Clicku204(e)
{
windowEvent = e;


if (true) {

	self.location.href="passo-5-envio-pj.html" + GetQuerystring();

}

}

var u300 = document.getElementById('u300');
gv_vAlignTable['u300'] = 'center';
var u301 = document.getElementById('u301');

var u302 = document.getElementById('u302');

var u303 = document.getElementById('u303');
gv_vAlignTable['u303'] = 'center';
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
gv_vAlignTable['u504'] = 'top';
var u505 = document.getElementById('u505');

var u506 = document.getElementById('u506');

var u507 = document.getElementById('u507');

var u508 = document.getElementById('u508');

if (bIE) u508.attachEvent("onblur", LostFocusu508);
else u508.addEventListener("blur", LostFocusu508, true);
function LostFocusu508(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u509', '' + (GetWidgetFormText('u507') * GetWidgetFormText('u508')) + '');

}

}

var u509 = document.getElementById('u509');

var u310 = document.getElementById('u310');

if (bIE) u310.attachEvent("onblur", LostFocusu310);
else u310.addEventListener("blur", LostFocusu310, true);
function LostFocusu310(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u311', '' + (GetWidgetFormText('u309') * GetWidgetFormText('u310')) + '');

SetWidgetFormText('u313', '' + (GetNum(GetWidgetFormText('u311')) + GetNum(GetWidgetFormText('u317'))) + '');

}

}

var u311 = document.getElementById('u311');

var u312 = document.getElementById('u312');
gv_vAlignTable['u312'] = 'top';
var u313 = document.getElementById('u313');

var u314 = document.getElementById('u314');

var u315 = document.getElementById('u315');

var u316 = document.getElementById('u316');

if (bIE) u316.attachEvent("onblur", LostFocusu316);
else u316.addEventListener("blur", LostFocusu316, true);
function LostFocusu316(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u317', '' + (GetWidgetFormText('u315') * GetWidgetFormText('u316')) + '');

}

}

var u317 = document.getElementById('u317');

var u318 = document.getElementById('u318');
gv_vAlignTable['u318'] = 'top';
var u319 = document.getElementById('u319');
gv_vAlignTable['u319'] = 'top';
var u514 = document.getElementById('u514');
gv_vAlignTable['u514'] = 'top';
var u515 = document.getElementById('u515');

var u516 = document.getElementById('u516');

var u517 = document.getElementById('u517');

var u518 = document.getElementById('u518');

u518.style.cursor = 'pointer';
if (bIE) u518.attachEvent("onclick", Clicku518);
else u518.addEventListener("click", Clicku518, true);
function Clicku518(e)
{
windowEvent = e;


if ((GetCheckState('u518')) == (true)) {

	MoveWidgetBy('u106',0,50,'swing',500);

	MoveWidgetBy('u147',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u518')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u106',0,-50,'swing',500);

	MoveWidgetBy('u147',0,-50,'swing',500);

}

}

var u519 = document.getElementById('u519');
gv_vAlignTable['u519'] = 'top';
var u320 = document.getElementById('u320');
gv_vAlignTable['u320'] = 'top';
var u321 = document.getElementById('u321');
gv_vAlignTable['u321'] = 'top';
var u322 = document.getElementById('u322');
gv_vAlignTable['u322'] = 'top';
var u323 = document.getElementById('u323');

var u324 = document.getElementById('u324');

var u325 = document.getElementById('u325');

var u326 = document.getElementById('u326');

u326.style.cursor = 'pointer';
if (bIE) u326.attachEvent("onclick", Clicku326);
else u326.addEventListener("click", Clicku326, true);
function Clicku326(e)
{
windowEvent = e;


if ((GetCheckState('u326')) == (true)) {

	MoveWidgetBy('u106',0,50,'swing',500);

	MoveWidgetBy('u147',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u326')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u106',0,-50,'swing',500);

	MoveWidgetBy('u147',0,-50,'swing',500);

}

}

var u327 = document.getElementById('u327');
gv_vAlignTable['u327'] = 'top';
var u328 = document.getElementById('u328');
gv_vAlignTable['u328'] = 'top';
var u329 = document.getElementById('u329');
gv_vAlignTable['u329'] = 'top';
var u520 = document.getElementById('u520');

var u523 = document.getElementById('u523');
gv_vAlignTable['u523'] = 'top';
var u524 = document.getElementById('u524');
gv_vAlignTable['u524'] = 'top';
var u525 = document.getElementById('u525');
gv_vAlignTable['u525'] = 'top';
var u526 = document.getElementById('u526');

var u527 = document.getElementById('u527');

var u528 = document.getElementById('u528');

var u529 = document.getElementById('u529');
gv_vAlignTable['u529'] = 'center';
var u330 = document.getElementById('u330');
gv_vAlignTable['u330'] = 'top';
var u331 = document.getElementById('u331');
gv_vAlignTable['u331'] = 'top';
var u332 = document.getElementById('u332');
gv_vAlignTable['u332'] = 'top';
var u333 = document.getElementById('u333');

var u334 = document.getElementById('u334');

if (bIE) u334.attachEvent("onblur", LostFocusu334);
else u334.addEventListener("blur", LostFocusu334, true);
function LostFocusu334(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u335', '' + (GetWidgetFormText('u333') * GetWidgetFormText('u334')) + '');

SetWidgetFormText('u337', '' + (GetNum(GetWidgetFormText('u335')) + GetNum(GetWidgetFormText('u341'))) + '');

}

}

var u335 = document.getElementById('u335');

var u336 = document.getElementById('u336');
gv_vAlignTable['u336'] = 'top';
var u337 = document.getElementById('u337');

var u338 = document.getElementById('u338');

var u339 = document.getElementById('u339');

var u530 = document.getElementById('u530');
gv_vAlignTable['u530'] = 'top';
var u534 = document.getElementById('u534');
gv_vAlignTable['u534'] = 'top';
var u535 = document.getElementById('u535');

var u536 = document.getElementById('u536');

if (bIE) u536.attachEvent("onblur", LostFocusu536);
else u536.addEventListener("blur", LostFocusu536, true);
function LostFocusu536(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u537', '' + (GetWidgetFormText('u535') * GetWidgetFormText('u536')) + '');

SetWidgetFormText('u539', '' + (GetNum(GetWidgetFormText('u537')) + GetNum(GetWidgetFormText('u543'))) + '');

}

}

var u537 = document.getElementById('u537');

var u538 = document.getElementById('u538');
gv_vAlignTable['u538'] = 'top';
var u539 = document.getElementById('u539');

var u340 = document.getElementById('u340');

if (bIE) u340.attachEvent("onblur", LostFocusu340);
else u340.addEventListener("blur", LostFocusu340, true);
function LostFocusu340(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u341', '' + (GetWidgetFormText('u339') * GetWidgetFormText('u340')) + '');

}

}

var u341 = document.getElementById('u341');

var u342 = document.getElementById('u342');
gv_vAlignTable['u342'] = 'top';
var u343 = document.getElementById('u343');
gv_vAlignTable['u343'] = 'top';
var u344 = document.getElementById('u344');
gv_vAlignTable['u344'] = 'top';
var u345 = document.getElementById('u345');
gv_vAlignTable['u345'] = 'top';
var u346 = document.getElementById('u346');
gv_vAlignTable['u346'] = 'top';
var u347 = document.getElementById('u347');

var u348 = document.getElementById('u348');

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

var u350 = document.getElementById('u350');

u350.style.cursor = 'pointer';
if (bIE) u350.attachEvent("onclick", Clicku350);
else u350.addEventListener("click", Clicku350, true);
function Clicku350(e)
{
windowEvent = e;


if ((GetCheckState('u350')) == (true)) {

	MoveWidgetBy('u106',0,50,'swing',500);

	MoveWidgetBy('u147',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u350')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u106',0,-50,'swing',500);

	MoveWidgetBy('u147',0,-50,'swing',500);

}

}

var u351 = document.getElementById('u351');
gv_vAlignTable['u351'] = 'top';
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

if (bIE) u358.attachEvent("onblur", LostFocusu358);
else u358.addEventListener("blur", LostFocusu358, true);
function LostFocusu358(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u359', '' + (GetWidgetFormText('u357') * GetWidgetFormText('u358')) + '');

SetWidgetFormText('u361', '' + (GetNum(GetWidgetFormText('u359')) + GetNum(GetWidgetFormText('u365'))) + '');

}

}

var u359 = document.getElementById('u359');

var u550 = document.getElementById('u550');

var u554 = document.getElementById('u554');

var u555 = document.getElementById('u555');

var u556 = document.getElementById('u556');
gv_vAlignTable['u556'] = 'center';
var u557 = document.getElementById('u557');
gv_vAlignTable['u557'] = 'top';
var u558 = document.getElementById('u558');
gv_vAlignTable['u558'] = 'top';
var u559 = document.getElementById('u559');

var u360 = document.getElementById('u360');
gv_vAlignTable['u360'] = 'top';
var u361 = document.getElementById('u361');

var u362 = document.getElementById('u362');

var u363 = document.getElementById('u363');

var u364 = document.getElementById('u364');

if (bIE) u364.attachEvent("onblur", LostFocusu364);
else u364.addEventListener("blur", LostFocusu364, true);
function LostFocusu364(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u365', '' + (GetWidgetFormText('u363') * GetWidgetFormText('u364')) + '');

}

}

var u365 = document.getElementById('u365');

var u366 = document.getElementById('u366');
gv_vAlignTable['u366'] = 'top';
var u367 = document.getElementById('u367');
gv_vAlignTable['u367'] = 'top';
var u368 = document.getElementById('u368');
gv_vAlignTable['u368'] = 'top';
var u369 = document.getElementById('u369');
gv_vAlignTable['u369'] = 'top';
var u564 = document.getElementById('u564');

var u565 = document.getElementById('u565');
gv_vAlignTable['u565'] = 'center';
var u566 = document.getElementById('u566');

var u567 = document.getElementById('u567');
gv_vAlignTable['u567'] = 'center';
var u568 = document.getElementById('u568');

var u569 = document.getElementById('u569');
gv_vAlignTable['u569'] = 'center';
var u370 = document.getElementById('u370');
gv_vAlignTable['u370'] = 'top';
var u371 = document.getElementById('u371');

var u372 = document.getElementById('u372');

var u373 = document.getElementById('u373');

var u374 = document.getElementById('u374');

u374.style.cursor = 'pointer';
if (bIE) u374.attachEvent("onclick", Clicku374);
else u374.addEventListener("click", Clicku374, true);
function Clicku374(e)
{
windowEvent = e;


if ((GetCheckState('u374')) == (true)) {

	MoveWidgetBy('u106',0,50,'swing',500);

	MoveWidgetBy('u147',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u374')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u106',0,-50,'swing',500);

	MoveWidgetBy('u147',0,-50,'swing',500);

}

}

var u375 = document.getElementById('u375');
gv_vAlignTable['u375'] = 'top';
var u376 = document.getElementById('u376');

var u377 = document.getElementById('u377');

var u378 = document.getElementById('u378');
gv_vAlignTable['u378'] = 'center';
var u379 = document.getElementById('u379');
gv_vAlignTable['u379'] = 'top';
var u574 = document.getElementById('u574');
gv_vAlignTable['u574'] = 'top';
var u575 = document.getElementById('u575');
gv_vAlignTable['u575'] = 'top';
var u576 = document.getElementById('u576');

var u577 = document.getElementById('u577');
gv_vAlignTable['u577'] = 'center';
var u578 = document.getElementById('u578');

var u579 = document.getElementById('u579');
gv_vAlignTable['u579'] = 'center';
var u380 = document.getElementById('u380');
gv_vAlignTable['u380'] = 'top';
var u381 = document.getElementById('u381');
gv_vAlignTable['u381'] = 'top';
var u382 = document.getElementById('u382');

var u383 = document.getElementById('u383');

var u384 = document.getElementById('u384');

var u385 = document.getElementById('u385');
gv_vAlignTable['u385'] = 'center';
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
gv_vAlignTable['u205'] = 'center';
var u393 = document.getElementById('u393');

var u394 = document.getElementById('u394');
gv_vAlignTable['u394'] = 'top';
var u395 = document.getElementById('u395');

var u396 = document.getElementById('u396');

var u397 = document.getElementById('u397');

var u398 = document.getElementById('u398');

if (bIE) u398.attachEvent("onblur", LostFocusu398);
else u398.addEventListener("blur", LostFocusu398, true);
function LostFocusu398(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u399', '' + (GetWidgetFormText('u397') * GetWidgetFormText('u398')) + '');

}

}

var u399 = document.getElementById('u399');

var u210 = document.getElementById('u210');

var u211 = document.getElementById('u211');
gv_vAlignTable['u211'] = 'center';
var u212 = document.getElementById('u212');
gv_vAlignTable['u212'] = 'top';
var u213 = document.getElementById('u213');
gv_vAlignTable['u213'] = 'top';
var u214 = document.getElementById('u214');
gv_vAlignTable['u214'] = 'top';
var u215 = document.getElementById('u215');

var u216 = document.getElementById('u216');

if (bIE) u216.attachEvent("onblur", LostFocusu216);
else u216.addEventListener("blur", LostFocusu216, true);
function LostFocusu216(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u217', '' + (GetWidgetFormText('u215') * GetWidgetFormText('u216')) + '');

SetWidgetFormText('u219', '' + (GetNum(GetWidgetFormText('u217')) + GetNum(GetWidgetFormText('u223'))) + '');

}

}

var u217 = document.getElementById('u217');

var u218 = document.getElementById('u218');
gv_vAlignTable['u218'] = 'top';
var u219 = document.getElementById('u219');

var u220 = document.getElementById('u220');

var u221 = document.getElementById('u221');

var u222 = document.getElementById('u222');

if (bIE) u222.attachEvent("onblur", LostFocusu222);
else u222.addEventListener("blur", LostFocusu222, true);
function LostFocusu222(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u223', '' + (GetWidgetFormText('u221') * GetWidgetFormText('u222')) + '');

}

}

var u223 = document.getElementById('u223');

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
gv_vAlignTable['u230'] = 'top';
var u231 = document.getElementById('u231');

var u232 = document.getElementById('u232');

var u233 = document.getElementById('u233');

u233.style.cursor = 'pointer';
if (bIE) u233.attachEvent("onclick", Clicku233);
else u233.addEventListener("click", Clicku233, true);
function Clicku233(e)
{
windowEvent = e;


if ((GetCheckState('u233')) == (true)) {

	MoveWidgetBy('u106',0,50,'swing',500);

	MoveWidgetBy('u147',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u233')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u106',0,-50,'swing',500);

	MoveWidgetBy('u147',0,-50,'swing',500);

}

}

var u234 = document.getElementById('u234');
gv_vAlignTable['u234'] = 'top';
var u235 = document.getElementById('u235');
gv_vAlignTable['u235'] = 'top';
var u236 = document.getElementById('u236');
gv_vAlignTable['u236'] = 'top';
var u237 = document.getElementById('u237');
gv_vAlignTable['u237'] = 'top';
var u238 = document.getElementById('u238');
gv_vAlignTable['u238'] = 'top';
var u239 = document.getElementById('u239');
gv_vAlignTable['u239'] = 'top';
var u240 = document.getElementById('u240');

var u241 = document.getElementById('u241');

if (bIE) u241.attachEvent("onblur", LostFocusu241);
else u241.addEventListener("blur", LostFocusu241, true);
function LostFocusu241(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u242', '' + (GetWidgetFormText('u240') * GetWidgetFormText('u241')) + '');

SetWidgetFormText('u244', '' + (GetNum(GetWidgetFormText('u242')) + GetNum(GetWidgetFormText('u248'))) + '');

}

}

var u242 = document.getElementById('u242');

var u243 = document.getElementById('u243');
gv_vAlignTable['u243'] = 'top';
var u244 = document.getElementById('u244');

var u245 = document.getElementById('u245');

var u246 = document.getElementById('u246');

var u247 = document.getElementById('u247');

if (bIE) u247.attachEvent("onblur", LostFocusu247);
else u247.addEventListener("blur", LostFocusu247, true);
function LostFocusu247(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u248', '' + (GetWidgetFormText('u246') * GetWidgetFormText('u247')) + '');

}

}

var u248 = document.getElementById('u248');

var u249 = document.getElementById('u249');
gv_vAlignTable['u249'] = 'top';
var u250 = document.getElementById('u250');
gv_vAlignTable['u250'] = 'top';
var u251 = document.getElementById('u251');
gv_vAlignTable['u251'] = 'top';
var u252 = document.getElementById('u252');
gv_vAlignTable['u252'] = 'top';
var u253 = document.getElementById('u253');
gv_vAlignTable['u253'] = 'top';
var u254 = document.getElementById('u254');

var u255 = document.getElementById('u255');

var u256 = document.getElementById('u256');

var u257 = document.getElementById('u257');

u257.style.cursor = 'pointer';
if (bIE) u257.attachEvent("onclick", Clicku257);
else u257.addEventListener("click", Clicku257, true);
function Clicku257(e)
{
windowEvent = e;


if ((GetCheckState('u257')) == (true)) {

	MoveWidgetBy('u106',0,50,'swing',500);

	MoveWidgetBy('u147',0,50,'swing',500);

	SetPanelVisibility('u45','','fade',500);

}
else
if ((GetCheckState('u257')) == (false)) {

	SetPanelVisibility('u45','hidden','none',500);

	SetPanelVisibility('u58','hidden','none',500);

	MoveWidgetBy('u106',0,-50,'swing',500);

	MoveWidgetBy('u147',0,-50,'swing',500);

}

}

var u258 = document.getElementById('u258');
gv_vAlignTable['u258'] = 'top';
var u259 = document.getElementById('u259');
gv_vAlignTable['u259'] = 'top';
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
gv_vAlignTable['u260'] = 'top';
var u261 = document.getElementById('u261');
gv_vAlignTable['u261'] = 'top';
var u262 = document.getElementById('u262');
gv_vAlignTable['u262'] = 'top';
var u263 = document.getElementById('u263');
gv_vAlignTable['u263'] = 'top';
var u264 = document.getElementById('u264');

var u265 = document.getElementById('u265');

if (bIE) u265.attachEvent("onblur", LostFocusu265);
else u265.addEventListener("blur", LostFocusu265, true);
function LostFocusu265(e)
{
windowEvent = e;


if (true) {

SetWidgetFormText('u266', '' + (GetWidgetFormText('u264') * GetWidgetFormText('u265')) + '');

SetWidgetFormText('u268', '' + (GetNum(GetWidgetFormText('u266')) + GetNum(GetWidgetFormText('u272'))) + '');

}

}

var u266 = document.getElementById('u266');

var u267 = document.getElementById('u267');
gv_vAlignTable['u267'] = 'top';
var u268 = document.getElementById('u268');

var u269 = document.getElementById('u269');

if (window.OnLoad) OnLoad();
