
var PageName = 'Login';
var PageId = 'e159961c09d04579946952e5cf9ecc59'
var PageUrl = 'Login.html'
document.title = 'Login';
var PageNotes = 
{
"pageName":"Login",
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

var u20 = document.getElementById('u20');

var u19 = document.getElementById('u19');

var u18 = document.getElementById('u18');
gv_vAlignTable['u18'] = 'top';
var u17 = document.getElementById('u17');

var u16 = document.getElementById('u16');
gv_vAlignTable['u16'] = 'top';
var u15 = document.getElementById('u15');

u15.style.cursor = 'pointer';
if (bIE) u15.attachEvent("onclick", Clicku15);
else u15.addEventListener("click", Clicku15, true);
function Clicku15(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u0','','none',500);

	BringToFront("u0");

}

}
gv_vAlignTable['u15'] = 'top';
var u10 = document.getElementById('u10');

if (bIE) u10.attachEvent("onfocus", Focusu10);
else u10.addEventListener("focus", Focusu10, true);
function Focusu10(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u19','hidden','none',500);

}

}

var u11 = document.getElementById('u11');
gv_vAlignTable['u11'] = 'top';
var u12 = document.getElementById('u12');

var u13 = document.getElementById('u13');
gv_vAlignTable['u13'] = 'top';
var u14 = document.getElementById('u14');

u14.style.cursor = 'pointer';
if (bIE) u14.attachEvent("onclick", Clicku14);
else u14.addEventListener("click", Clicku14, true);
function Clicku14(e)
{
windowEvent = e;


if ((GetWidgetFormText('u10')) == ('cnpj')) {

	self.location.href="seleciona-edital-pj.html" + GetQuerystring();

}
else
if ((GetWidgetFormText('u10')) == ('cpf')) {

	self.location.href="seleciona-edital-pf.html" + GetQuerystring();

}
else
if ((GetWidgetFormText('u10')) == ('comissao')) {

	self.location.href="lista-inscritos-comissao.html" + GetQuerystring();

}
else
if ((GetWidgetFormText('u10')) == ('coordenador')) {

	self.location.href="home-administracao-edital.html" + GetQuerystring();

}
else
if (true) {

	SetPanelVisibility('u19','','fade',50);

}

}

var u0 = document.getElementById('u0');

var u1 = document.getElementById('u1');

u1.style.cursor = 'pointer';
if (bIE) u1.attachEvent("onclick", Clicku1);
else u1.addEventListener("click", Clicku1, true);
function Clicku1(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u0','hidden','none',500);

}

}

var u2 = document.getElementById('u2');
gv_vAlignTable['u2'] = 'center';
var u3 = document.getElementById('u3');

u3.style.cursor = 'pointer';
if (bIE) u3.attachEvent("onclick", Clicku3);
else u3.addEventListener("click", Clicku3, true);
function Clicku3(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u0','hidden','none',500);

}

}

var u4 = document.getElementById('u4');
gv_vAlignTable['u4'] = 'center';
var u5 = document.getElementById('u5');

u5.style.cursor = 'pointer';
if (bIE) u5.attachEvent("onclick", Clicku5);
else u5.addEventListener("click", Clicku5, true);
function Clicku5(e)
{
windowEvent = e;


if (true) {

	self.location.href="cadastro-sistema-pf.html" + GetQuerystring();

	SetPanelVisibility('u0','hidden','none',500);

}

}

var u6 = document.getElementById('u6');

u6.style.cursor = 'pointer';
if (bIE) u6.attachEvent("onclick", Clicku6);
else u6.addEventListener("click", Clicku6, true);
function Clicku6(e)
{
windowEvent = e;


if (true) {

	self.location.href="cadastro-sistema-pj.html" + GetQuerystring();

	SetPanelVisibility('u0','hidden','none',500);

}

}

var u7 = document.getElementById('u7');
gv_vAlignTable['u7'] = 'top';
var u8 = document.getElementById('u8');

u8.style.cursor = 'pointer';
if (bIE) u8.attachEvent("onclick", Clicku8);
else u8.addEventListener("click", Clicku8, true);
function Clicku8(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u0','hidden','none',500);

}

}

var u9 = document.getElementById('u9');
gv_vAlignTable['u9'] = 'center';
var u21 = document.getElementById('u21');
gv_vAlignTable['u21'] = 'center';
var u22 = document.getElementById('u22');
gv_vAlignTable['u22'] = 'top';
if (window.OnLoad) OnLoad();
