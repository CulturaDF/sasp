
var PageName = 'lista-inscritos-comissao';
var PageId = 'fd1843fa285a496a8af6f0da088072a8'
var PageUrl = 'lista-inscritos-comissao.html'
document.title = 'lista-inscritos-comissao';
var PageNotes = 
{
"pageName":"lista-inscritos-comissao",
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

var u230 = document.getElementById('u230');
gv_vAlignTable['u230'] = 'center';
var u231 = document.getElementById('u231');

var u232 = document.getElementById('u232');
gv_vAlignTable['u232'] = 'center';
var u233 = document.getElementById('u233');

var u70 = document.getElementById('u70');
gv_vAlignTable['u70'] = 'top';
var u71 = document.getElementById('u71');

var u100 = document.getElementById('u100');
gv_vAlignTable['u100'] = 'center';
var u101 = document.getElementById('u101');
gv_vAlignTable['u101'] = 'top';
var u102 = document.getElementById('u102');
gv_vAlignTable['u102'] = 'top';
var u103 = document.getElementById('u103');
gv_vAlignTable['u103'] = 'top';
var u104 = document.getElementById('u104');

var u105 = document.getElementById('u105');
gv_vAlignTable['u105'] = 'center';
var u106 = document.getElementById('u106');

var u107 = document.getElementById('u107');
gv_vAlignTable['u107'] = 'center';
var u108 = document.getElementById('u108');

var u109 = document.getElementById('u109');
gv_vAlignTable['u109'] = 'center';
var u80 = document.getElementById('u80');
gv_vAlignTable['u80'] = 'top';
var u81 = document.getElementById('u81');
gv_vAlignTable['u81'] = 'top';
var u82 = document.getElementById('u82');

var u83 = document.getElementById('u83');
gv_vAlignTable['u83'] = 'center';
var u84 = document.getElementById('u84');

var u85 = document.getElementById('u85');
gv_vAlignTable['u85'] = 'center';
var u86 = document.getElementById('u86');

var u87 = document.getElementById('u87');
gv_vAlignTable['u87'] = 'center';
var u88 = document.getElementById('u88');

var u89 = document.getElementById('u89');
gv_vAlignTable['u89'] = 'center';
var u118 = document.getElementById('u118');
gv_vAlignTable['u118'] = 'center';
var u119 = document.getElementById('u119');

var u90 = document.getElementById('u90');
gv_vAlignTable['u90'] = 'top';
var u91 = document.getElementById('u91');
gv_vAlignTable['u91'] = 'top';
var u92 = document.getElementById('u92');
gv_vAlignTable['u92'] = 'top';
var u93 = document.getElementById('u93');

var u94 = document.getElementById('u94');
gv_vAlignTable['u94'] = 'center';
var u95 = document.getElementById('u95');

var u96 = document.getElementById('u96');
gv_vAlignTable['u96'] = 'center';
var u97 = document.getElementById('u97');

var u98 = document.getElementById('u98');
gv_vAlignTable['u98'] = 'center';
var u127 = document.getElementById('u127');
gv_vAlignTable['u127'] = 'center';
var u128 = document.getElementById('u128');

var u129 = document.getElementById('u129');
gv_vAlignTable['u129'] = 'center';
var u130 = document.getElementById('u130');

var u131 = document.getElementById('u131');
gv_vAlignTable['u131'] = 'center';
var u132 = document.getElementById('u132');

var u133 = document.getElementById('u133');
gv_vAlignTable['u133'] = 'center';
var u134 = document.getElementById('u134');
gv_vAlignTable['u134'] = 'top';
var u135 = document.getElementById('u135');
gv_vAlignTable['u135'] = 'top';
var u136 = document.getElementById('u136');
gv_vAlignTable['u136'] = 'top';
var u137 = document.getElementById('u137');

var u138 = document.getElementById('u138');
gv_vAlignTable['u138'] = 'center';
var u139 = document.getElementById('u139');

var u140 = document.getElementById('u140');
gv_vAlignTable['u140'] = 'center';
var u141 = document.getElementById('u141');

var u142 = document.getElementById('u142');
gv_vAlignTable['u142'] = 'center';
var u143 = document.getElementById('u143');

var u144 = document.getElementById('u144');
gv_vAlignTable['u144'] = 'center';
var u145 = document.getElementById('u145');
gv_vAlignTable['u145'] = 'top';
var u146 = document.getElementById('u146');
gv_vAlignTable['u146'] = 'top';
var u147 = document.getElementById('u147');
gv_vAlignTable['u147'] = 'top';
var u148 = document.getElementById('u148');

var u149 = document.getElementById('u149');
gv_vAlignTable['u149'] = 'center';
var u150 = document.getElementById('u150');

var u151 = document.getElementById('u151');
gv_vAlignTable['u151'] = 'center';
var u152 = document.getElementById('u152');

var u153 = document.getElementById('u153');
gv_vAlignTable['u153'] = 'center';
var u154 = document.getElementById('u154');

var u155 = document.getElementById('u155');
gv_vAlignTable['u155'] = 'center';
var u156 = document.getElementById('u156');
gv_vAlignTable['u156'] = 'top';
var u157 = document.getElementById('u157');
gv_vAlignTable['u157'] = 'top';
var u158 = document.getElementById('u158');
gv_vAlignTable['u158'] = 'top';
var u159 = document.getElementById('u159');

var u234 = document.getElementById('u234');
gv_vAlignTable['u234'] = 'center';
var u235 = document.getElementById('u235');

var u160 = document.getElementById('u160');
gv_vAlignTable['u160'] = 'center';
var u161 = document.getElementById('u161');

var u162 = document.getElementById('u162');
gv_vAlignTable['u162'] = 'center';
var u163 = document.getElementById('u163');

var u164 = document.getElementById('u164');
gv_vAlignTable['u164'] = 'center';
var u165 = document.getElementById('u165');

var u166 = document.getElementById('u166');
gv_vAlignTable['u166'] = 'center';
var u167 = document.getElementById('u167');
gv_vAlignTable['u167'] = 'top';
var u168 = document.getElementById('u168');
gv_vAlignTable['u168'] = 'top';
var u169 = document.getElementById('u169');
gv_vAlignTable['u169'] = 'top';
var u170 = document.getElementById('u170');

var u171 = document.getElementById('u171');
gv_vAlignTable['u171'] = 'center';
var u172 = document.getElementById('u172');

var u173 = document.getElementById('u173');
gv_vAlignTable['u173'] = 'center';
var u174 = document.getElementById('u174');

var u175 = document.getElementById('u175');
gv_vAlignTable['u175'] = 'center';
var u176 = document.getElementById('u176');

var u177 = document.getElementById('u177');
gv_vAlignTable['u177'] = 'center';
var u178 = document.getElementById('u178');
gv_vAlignTable['u178'] = 'top';
var u179 = document.getElementById('u179');
gv_vAlignTable['u179'] = 'top';
var u251 = document.getElementById('u251');
gv_vAlignTable['u251'] = 'top';
var u252 = document.getElementById('u252');
gv_vAlignTable['u252'] = 'top';
var u200 = document.getElementById('u200');
gv_vAlignTable['u200'] = 'center';
var u72 = document.getElementById('u72');
gv_vAlignTable['u72'] = 'center';
var u73 = document.getElementById('u73');

var u74 = document.getElementById('u74');
gv_vAlignTable['u74'] = 'center';
var u75 = document.getElementById('u75');

var u76 = document.getElementById('u76');
gv_vAlignTable['u76'] = 'center';
var u77 = document.getElementById('u77');

var u78 = document.getElementById('u78');
gv_vAlignTable['u78'] = 'center';
var u79 = document.getElementById('u79');
gv_vAlignTable['u79'] = 'top';
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
gv_vAlignTable['u185'] = 'top';
var u186 = document.getElementById('u186');

var u187 = document.getElementById('u187');

var u188 = document.getElementById('u188');
gv_vAlignTable['u188'] = 'center';
var u189 = document.getElementById('u189');

var u210 = document.getElementById('u210');
gv_vAlignTable['u210'] = 'center';
var u211 = document.getElementById('u211');

var u212 = document.getElementById('u212');
gv_vAlignTable['u212'] = 'center';
var u213 = document.getElementById('u213');

var u214 = document.getElementById('u214');
gv_vAlignTable['u214'] = 'center';
var u215 = document.getElementById('u215');

var u190 = document.getElementById('u190');
gv_vAlignTable['u190'] = 'center';
var u191 = document.getElementById('u191');

var u192 = document.getElementById('u192');
gv_vAlignTable['u192'] = 'center';
var u193 = document.getElementById('u193');

var u194 = document.getElementById('u194');
gv_vAlignTable['u194'] = 'center';
var u195 = document.getElementById('u195');

var u196 = document.getElementById('u196');
gv_vAlignTable['u196'] = 'center';
var u197 = document.getElementById('u197');

var u198 = document.getElementById('u198');
gv_vAlignTable['u198'] = 'center';
var u199 = document.getElementById('u199');

var u220 = document.getElementById('u220');
gv_vAlignTable['u220'] = 'center';
var u221 = document.getElementById('u221');

var u222 = document.getElementById('u222');
gv_vAlignTable['u222'] = 'center';
var u223 = document.getElementById('u223');

var u224 = document.getElementById('u224');
gv_vAlignTable['u224'] = 'center';
var u225 = document.getElementById('u225');

var u99 = document.getElementById('u99');

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

var u7 = document.getElementById('u7');
gv_vAlignTable['u7'] = 'center';
var u8 = document.getElementById('u8');

var u9 = document.getElementById('u9');
gv_vAlignTable['u9'] = 'center';
var u240 = document.getElementById('u240');
gv_vAlignTable['u240'] = 'center';
var u241 = document.getElementById('u241');

var u242 = document.getElementById('u242');
gv_vAlignTable['u242'] = 'center';
var u243 = document.getElementById('u243');

var u244 = document.getElementById('u244');
gv_vAlignTable['u244'] = 'center';
var u245 = document.getElementById('u245');

var u10 = document.getElementById('u10');
gv_vAlignTable['u10'] = 'top';
var u11 = document.getElementById('u11');
gv_vAlignTable['u11'] = 'top';
var u12 = document.getElementById('u12');
gv_vAlignTable['u12'] = 'top';
var u13 = document.getElementById('u13');

u13.style.cursor = 'pointer';
if (bIE) u13.attachEvent("onclick", Clicku13);
else u13.addEventListener("click", Clicku13, true);
function Clicku13(e)
{
windowEvent = e;


if (true) {

	self.location.href="detalha-inscricao-de-curta-metragem.html" + GetQuerystring();

}

}
gv_vAlignTable['u13'] = 'top';
var u14 = document.getElementById('u14');
gv_vAlignTable['u14'] = 'top';
var u15 = document.getElementById('u15');
gv_vAlignTable['u15'] = 'top';
var u16 = document.getElementById('u16');

var u17 = document.getElementById('u17');
gv_vAlignTable['u17'] = 'center';
var u18 = document.getElementById('u18');

var u19 = document.getElementById('u19');
gv_vAlignTable['u19'] = 'center';
var u110 = document.getElementById('u110');

var u111 = document.getElementById('u111');
gv_vAlignTable['u111'] = 'center';
var u112 = document.getElementById('u112');
gv_vAlignTable['u112'] = 'top';
var u113 = document.getElementById('u113');
gv_vAlignTable['u113'] = 'top';
var u114 = document.getElementById('u114');
gv_vAlignTable['u114'] = 'top';
var u250 = document.getElementById('u250');
gv_vAlignTable['u250'] = 'center';
var u115 = document.getElementById('u115');

var u116 = document.getElementById('u116');
gv_vAlignTable['u116'] = 'center';
var u117 = document.getElementById('u117');

var u20 = document.getElementById('u20');

var u21 = document.getElementById('u21');
gv_vAlignTable['u21'] = 'center';
var u22 = document.getElementById('u22');

var u23 = document.getElementById('u23');
gv_vAlignTable['u23'] = 'center';
var u24 = document.getElementById('u24');
gv_vAlignTable['u24'] = 'top';
var u25 = document.getElementById('u25');
gv_vAlignTable['u25'] = 'top';
var u26 = document.getElementById('u26');
gv_vAlignTable['u26'] = 'top';
var u27 = document.getElementById('u27');

var u28 = document.getElementById('u28');
gv_vAlignTable['u28'] = 'center';
var u29 = document.getElementById('u29');

var u206 = document.getElementById('u206');
gv_vAlignTable['u206'] = 'center';
var u207 = document.getElementById('u207');

var u208 = document.getElementById('u208');
gv_vAlignTable['u208'] = 'center';
var u209 = document.getElementById('u209');

var u120 = document.getElementById('u120');
gv_vAlignTable['u120'] = 'center';
var u121 = document.getElementById('u121');

var u122 = document.getElementById('u122');
gv_vAlignTable['u122'] = 'center';
var u123 = document.getElementById('u123');
gv_vAlignTable['u123'] = 'top';
var u124 = document.getElementById('u124');
gv_vAlignTable['u124'] = 'top';
var u125 = document.getElementById('u125');
gv_vAlignTable['u125'] = 'top';
var u126 = document.getElementById('u126');

var u30 = document.getElementById('u30');
gv_vAlignTable['u30'] = 'center';
var u31 = document.getElementById('u31');

var u32 = document.getElementById('u32');
gv_vAlignTable['u32'] = 'center';
var u33 = document.getElementById('u33');

var u34 = document.getElementById('u34');
gv_vAlignTable['u34'] = 'center';
var u35 = document.getElementById('u35');
gv_vAlignTable['u35'] = 'top';
var u36 = document.getElementById('u36');
gv_vAlignTable['u36'] = 'top';
var u37 = document.getElementById('u37');
gv_vAlignTable['u37'] = 'top';
var u38 = document.getElementById('u38');

var u39 = document.getElementById('u39');
gv_vAlignTable['u39'] = 'center';
var u216 = document.getElementById('u216');
gv_vAlignTable['u216'] = 'center';
var u217 = document.getElementById('u217');

var u218 = document.getElementById('u218');
gv_vAlignTable['u218'] = 'center';
var u219 = document.getElementById('u219');

x = 0;
y = 0;
InsertAfterBegin(document.getElementById('u219ann'), "<div id='u219Note' class='annnoteimage' style='left:" + x + ";top:" + y + "'></div>");
$('#u219Note').click(function(e) { ToggleWorkflow(e, 'u219', 300, 150, false); return false; });
var u219Ann = 
{
"label":"?",
"Specification":"Define se a inscrição já foi analisada."};

var u201 = document.getElementById('u201');

var u202 = document.getElementById('u202');
gv_vAlignTable['u202'] = 'center';
var u203 = document.getElementById('u203');

var u204 = document.getElementById('u204');
gv_vAlignTable['u204'] = 'center';
var u205 = document.getElementById('u205');

var u40 = document.getElementById('u40');

var u41 = document.getElementById('u41');
gv_vAlignTable['u41'] = 'center';
var u42 = document.getElementById('u42');

var u43 = document.getElementById('u43');
gv_vAlignTable['u43'] = 'center';
var u44 = document.getElementById('u44');

var u45 = document.getElementById('u45');
gv_vAlignTable['u45'] = 'center';
var u46 = document.getElementById('u46');
gv_vAlignTable['u46'] = 'top';
var u47 = document.getElementById('u47');
gv_vAlignTable['u47'] = 'top';
var u48 = document.getElementById('u48');
gv_vAlignTable['u48'] = 'top';
var u49 = document.getElementById('u49');

var u226 = document.getElementById('u226');
gv_vAlignTable['u226'] = 'center';
var u227 = document.getElementById('u227');

var u228 = document.getElementById('u228');
gv_vAlignTable['u228'] = 'center';
var u229 = document.getElementById('u229');

var u50 = document.getElementById('u50');
gv_vAlignTable['u50'] = 'center';
var u51 = document.getElementById('u51');

var u52 = document.getElementById('u52');
gv_vAlignTable['u52'] = 'center';
var u53 = document.getElementById('u53');

var u54 = document.getElementById('u54');
gv_vAlignTable['u54'] = 'center';
var u55 = document.getElementById('u55');

var u56 = document.getElementById('u56');
gv_vAlignTable['u56'] = 'center';
var u57 = document.getElementById('u57');
gv_vAlignTable['u57'] = 'top';
var u58 = document.getElementById('u58');
gv_vAlignTable['u58'] = 'top';
var u59 = document.getElementById('u59');
gv_vAlignTable['u59'] = 'top';
var u236 = document.getElementById('u236');
gv_vAlignTable['u236'] = 'center';
var u237 = document.getElementById('u237');

var u238 = document.getElementById('u238');
gv_vAlignTable['u238'] = 'center';
var u239 = document.getElementById('u239');

var u60 = document.getElementById('u60');

var u61 = document.getElementById('u61');
gv_vAlignTable['u61'] = 'center';
var u62 = document.getElementById('u62');

var u63 = document.getElementById('u63');
gv_vAlignTable['u63'] = 'center';
var u64 = document.getElementById('u64');

var u65 = document.getElementById('u65');
gv_vAlignTable['u65'] = 'center';
var u66 = document.getElementById('u66');

var u67 = document.getElementById('u67');
gv_vAlignTable['u67'] = 'center';
var u68 = document.getElementById('u68');
gv_vAlignTable['u68'] = 'top';
var u69 = document.getElementById('u69');
gv_vAlignTable['u69'] = 'top';
var u246 = document.getElementById('u246');
gv_vAlignTable['u246'] = 'center';
var u247 = document.getElementById('u247');

var u248 = document.getElementById('u248');
gv_vAlignTable['u248'] = 'center';
var u249 = document.getElementById('u249');

if (window.OnLoad) OnLoad();
