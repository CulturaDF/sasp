
var PageName = 'passo-2-dados-diretor';
var PageId = 'ba45f79077034b9badf47b78c9037db7'
var PageUrl = 'passo-2-dados-diretor.html'
document.title = 'passo-2-dados-diretor';
var PageNotes = 
{
"pageName":"passo-2-dados-diretor",
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

var u80 = document.getElementById('u80');
gv_vAlignTable['u80'] = 'top';
var u81 = document.getElementById('u81');

var u82 = document.getElementById('u82');
gv_vAlignTable['u82'] = 'top';
var u83 = document.getElementById('u83');

var u84 = document.getElementById('u84');

var u85 = document.getElementById('u85');

var u86 = document.getElementById('u86');
gv_vAlignTable['u86'] = 'center';
var u87 = document.getElementById('u87');

var u88 = document.getElementById('u88');
gv_vAlignTable['u88'] = 'center';
var u89 = document.getElementById('u89');

u89.style.cursor = 'pointer';
if (bIE) u89.attachEvent("onclick", Clicku89);
else u89.addEventListener("click", Clicku89, true);
function Clicku89(e)
{
windowEvent = e;


if (true) {

	self.location.href="passo-4-orcamento.html" + GetQuerystring();

}

}

var u90 = document.getElementById('u90');
gv_vAlignTable['u90'] = 'center';
var u91 = document.getElementById('u91');

u91.style.cursor = 'pointer';
if (bIE) u91.attachEvent("onclick", Clicku91);
else u91.addEventListener("click", Clicku91, true);
function Clicku91(e)
{
windowEvent = e;


if (true) {

	self.location.href="passo-1-dados-projeto.html" + GetQuerystring();

}

}

var u92 = document.getElementById('u92');
gv_vAlignTable['u92'] = 'center';
var u10 = document.getElementById('u10');
gv_vAlignTable['u10'] = 'center';
var u11 = document.getElementById('u11');

var u12 = document.getElementById('u12');

var u13 = document.getElementById('u13');

var u14 = document.getElementById('u14');

var u15 = document.getElementById('u15');

var u16 = document.getElementById('u16');

var u17 = document.getElementById('u17');
gv_vAlignTable['u17'] = 'top';
var u18 = document.getElementById('u18');
gv_vAlignTable['u18'] = 'top';
var u19 = document.getElementById('u19');
gv_vAlignTable['u19'] = 'top';
var u110 = document.getElementById('u110');

var u111 = document.getElementById('u111');
gv_vAlignTable['u111'] = 'top';
var u112 = document.getElementById('u112');

var u113 = document.getElementById('u113');
gv_vAlignTable['u113'] = 'top';
var u114 = document.getElementById('u114');
gv_vAlignTable['u114'] = 'top';
var u115 = document.getElementById('u115');

var u20 = document.getElementById('u20');

var u21 = document.getElementById('u21');
gv_vAlignTable['u21'] = 'center';
var u22 = document.getElementById('u22');

var u23 = document.getElementById('u23');

var u24 = document.getElementById('u24');

var u25 = document.getElementById('u25');

var u26 = document.getElementById('u26');

var u27 = document.getElementById('u27');

var u28 = document.getElementById('u28');
gv_vAlignTable['u28'] = 'top';
var u29 = document.getElementById('u29');
gv_vAlignTable['u29'] = 'top';
var u100 = document.getElementById('u100');
gv_vAlignTable['u100'] = 'top';
var u101 = document.getElementById('u101');

u101.style.cursor = 'pointer';
if (bIE) u101.attachEvent("onclick", Clicku101);
else u101.addEventListener("click", Clicku101, true);
function Clicku101(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u84','hidden','none',500);

	BringToFront("u48");

	SetPanelState('u48', 'pd0u48','none','',500,'fade','',500);

}

}
gv_vAlignTable['u101'] = 'top';
var u102 = document.getElementById('u102');
gv_vAlignTable['u102'] = 'top';
var u103 = document.getElementById('u103');

var u104 = document.getElementById('u104');
gv_vAlignTable['u104'] = 'top';
var u105 = document.getElementById('u105');

var u106 = document.getElementById('u106');
gv_vAlignTable['u106'] = 'top';
var u107 = document.getElementById('u107');

var u108 = document.getElementById('u108');

var u109 = document.getElementById('u109');
gv_vAlignTable['u109'] = 'top';
var u127 = document.getElementById('u127');

var u128 = document.getElementById('u128');
gv_vAlignTable['u128'] = 'center';
var u129 = document.getElementById('u129');
gv_vAlignTable['u129'] = 'top';
var u30 = document.getElementById('u30');

var u31 = document.getElementById('u31');
gv_vAlignTable['u31'] = 'center';
var u32 = document.getElementById('u32');

var u33 = document.getElementById('u33');

var u34 = document.getElementById('u34');

var u35 = document.getElementById('u35');

var u36 = document.getElementById('u36');

var u37 = document.getElementById('u37');

var u38 = document.getElementById('u38');
gv_vAlignTable['u38'] = 'top';
var u39 = document.getElementById('u39');
gv_vAlignTable['u39'] = 'top';
var u93 = document.getElementById('u93');

var u94 = document.getElementById('u94');

var u95 = document.getElementById('u95');

var u96 = document.getElementById('u96');

var u97 = document.getElementById('u97');

var u98 = document.getElementById('u98');

var u99 = document.getElementById('u99');
gv_vAlignTable['u99'] = 'top';
var u116 = document.getElementById('u116');
gv_vAlignTable['u116'] = 'top';
var u117 = document.getElementById('u117');

var u118 = document.getElementById('u118');
gv_vAlignTable['u118'] = 'top';
var u119 = document.getElementById('u119');

var u40 = document.getElementById('u40');

u40.style.cursor = 'pointer';
if (bIE) u40.attachEvent("onclick", Clicku40);
else u40.addEventListener("click", Clicku40, true);
function Clicku40(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u2','hidden','none',500);

	SetPanelVisibility('u48','','none',500);

	BringToFront("u48");

}

}
gv_vAlignTable['u40'] = 'top';
var u41 = document.getElementById('u41');

u41.style.cursor = 'pointer';
if (bIE) u41.attachEvent("onclick", Clicku41);
else u41.addEventListener("click", Clicku41, true);
function Clicku41(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u2','hidden','none',500);

	SetPanelVisibility('u48','','none',500);

	BringToFront("u48");

}

}
gv_vAlignTable['u41'] = 'top';
var u42 = document.getElementById('u42');
gv_vAlignTable['u42'] = 'top';
var u43 = document.getElementById('u43');

var u44 = document.getElementById('u44');
gv_vAlignTable['u44'] = 'top';
var u45 = document.getElementById('u45');

var u46 = document.getElementById('u46');
gv_vAlignTable['u46'] = 'top';
var u47 = document.getElementById('u47');

var u48 = document.getElementById('u48');

var u49 = document.getElementById('u49');

var u120 = document.getElementById('u120');
gv_vAlignTable['u120'] = 'top';
var u121 = document.getElementById('u121');

var u122 = document.getElementById('u122');
gv_vAlignTable['u122'] = 'top';
var u123 = document.getElementById('u123');
gv_vAlignTable['u123'] = 'top';
var u124 = document.getElementById('u124');

var u125 = document.getElementById('u125');

u125.style.cursor = 'pointer';
if (bIE) u125.attachEvent("onclick", Clicku125);
else u125.addEventListener("click", Clicku125, true);
function Clicku125(e)
{
windowEvent = e;


if (true) {

	self.location.href="passo-1-dados-projeto.html" + GetQuerystring();

}

}

var u126 = document.getElementById('u126');
gv_vAlignTable['u126'] = 'center';
var u0 = document.getElementById('u0');

var u1 = document.getElementById('u1');
gv_vAlignTable['u1'] = 'center';
var u2 = document.getElementById('u2');

var u3 = document.getElementById('u3');

var u4 = document.getElementById('u4');
gv_vAlignTable['u4'] = 'center';
var u5 = document.getElementById('u5');

var u6 = document.getElementById('u6');
gv_vAlignTable['u6'] = 'center';
var u7 = document.getElementById('u7');

u7.style.cursor = 'pointer';
if (bIE) u7.attachEvent("onclick", Clicku7);
else u7.addEventListener("click", Clicku7, true);
function Clicku7(e)
{
windowEvent = e;


if (true) {

	self.location.href="passo-4-orcamento.html" + GetQuerystring();

}

}

var u8 = document.getElementById('u8');
gv_vAlignTable['u8'] = 'center';
var u9 = document.getElementById('u9');

u9.style.cursor = 'pointer';
if (bIE) u9.attachEvent("onclick", Clicku9);
else u9.addEventListener("click", Clicku9, true);
function Clicku9(e)
{
windowEvent = e;


if (true) {

	self.location.href="passo-1-dados-projeto.html" + GetQuerystring();

}

}

var u50 = document.getElementById('u50');
gv_vAlignTable['u50'] = 'center';
var u51 = document.getElementById('u51');

var u52 = document.getElementById('u52');
gv_vAlignTable['u52'] = 'center';
var u53 = document.getElementById('u53');

var u54 = document.getElementById('u54');

var u55 = document.getElementById('u55');

var u56 = document.getElementById('u56');

var u57 = document.getElementById('u57');

var u58 = document.getElementById('u58');

var u59 = document.getElementById('u59');
gv_vAlignTable['u59'] = 'top';
var u130 = document.getElementById('u130');
gv_vAlignTable['u130'] = 'top';
var u131 = document.getElementById('u131');
gv_vAlignTable['u131'] = 'top';
var u132 = document.getElementById('u132');

var u133 = document.getElementById('u133');

var u134 = document.getElementById('u134');
gv_vAlignTable['u134'] = 'center';
var u135 = document.getElementById('u135');

var u136 = document.getElementById('u136');
gv_vAlignTable['u136'] = 'center';
var u137 = document.getElementById('u137');
gv_vAlignTable['u137'] = 'top';
var u138 = document.getElementById('u138');
gv_vAlignTable['u138'] = 'top';
var u139 = document.getElementById('u139');

var u60 = document.getElementById('u60');
gv_vAlignTable['u60'] = 'top';
var u61 = document.getElementById('u61');
gv_vAlignTable['u61'] = 'top';
var u62 = document.getElementById('u62');

var u63 = document.getElementById('u63');
gv_vAlignTable['u63'] = 'center';
var u64 = document.getElementById('u64');

var u65 = document.getElementById('u65');

var u66 = document.getElementById('u66');

var u67 = document.getElementById('u67');

var u68 = document.getElementById('u68');

var u69 = document.getElementById('u69');

var u140 = document.getElementById('u140');

var u141 = document.getElementById('u141');

var u142 = document.getElementById('u142');
gv_vAlignTable['u142'] = 'center';
var u143 = document.getElementById('u143');
gv_vAlignTable['u143'] = 'top';
var u144 = document.getElementById('u144');

var u145 = document.getElementById('u145');
gv_vAlignTable['u145'] = 'top';
var u146 = document.getElementById('u146');
gv_vAlignTable['u146'] = 'top';
var u147 = document.getElementById('u147');
gv_vAlignTable['u147'] = 'top';
var u148 = document.getElementById('u148');
gv_vAlignTable['u148'] = 'top';
var u149 = document.getElementById('u149');
gv_vAlignTable['u149'] = 'top';
var u70 = document.getElementById('u70');
gv_vAlignTable['u70'] = 'top';
var u71 = document.getElementById('u71');
gv_vAlignTable['u71'] = 'top';
var u72 = document.getElementById('u72');

u72.style.cursor = 'pointer';
if (bIE) u72.attachEvent("onclick", Clicku72);
else u72.addEventListener("click", Clicku72, true);
function Clicku72(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u48','hidden','none',500);

	BringToFront("u2");

	SetPanelState('u2', 'pd0u2','none','',500,'fade','',500);

}

}
gv_vAlignTable['u72'] = 'top';
var u73 = document.getElementById('u73');

u73.style.cursor = 'pointer';
if (bIE) u73.attachEvent("onclick", Clicku73);
else u73.addEventListener("click", Clicku73, true);
function Clicku73(e)
{
windowEvent = e;


if (true) {

	self.location.href="passo-4-orcamento.html" + GetQuerystring();

}

}

var u74 = document.getElementById('u74');
gv_vAlignTable['u74'] = 'center';
var u75 = document.getElementById('u75');

u75.style.cursor = 'pointer';
if (bIE) u75.attachEvent("onclick", Clicku75);
else u75.addEventListener("click", Clicku75, true);
function Clicku75(e)
{
windowEvent = e;


if (true) {

	self.location.href="passo-1-dados-projeto.html" + GetQuerystring();

}

}

var u76 = document.getElementById('u76');
gv_vAlignTable['u76'] = 'center';
var u77 = document.getElementById('u77');

u77.style.cursor = 'pointer';
if (bIE) u77.attachEvent("onclick", Clicku77);
else u77.addEventListener("click", Clicku77, true);
function Clicku77(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u48','hidden','none',500);

	SetPanelVisibility('u84','','none',500);

	BringToFront("u84");

}

}
gv_vAlignTable['u77'] = 'top';
var u78 = document.getElementById('u78');
gv_vAlignTable['u78'] = 'top';
var u79 = document.getElementById('u79');

var u150 = document.getElementById('u150');

var u151 = document.getElementById('u151');
gv_vAlignTable['u151'] = 'top';
var u152 = document.getElementById('u152');

if (window.OnLoad) OnLoad();
