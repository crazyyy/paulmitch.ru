if(function(){for(var e,t=function(){},a=["assert","clear","count","debug","dir","dirxml","error","exception","group","groupCollapsed","groupEnd","info","log","markTimeline","profile","profileEnd","table","time","timeEnd","timeline","timelineEnd","timeStamp","trace","warn"],i=a.length,r=window.console=window.console||{};i--;)e=a[i],r[e]||(r[e]=t)}(),!QUnit.urlParams.storage){simpleCart.empty(),simpleCart.add({name:"Cool T-shirt",price:25,thumb:"http://www.google.com/intl/en_com/images/srpr/logo3w.png"});var mark=document.location.href.match(/\?/)?"&":"?";document.location.href=document.location.href+mark+"storage=true"}module("simpleCart-storage"),test("proper loading after page refesh",function(){var e=simpleCart.find({})[0];same(e.quantity(),1,"item quantity loaded properly"),same(e.get("name"),"Cool T-shirt","item name loaded properly"),same(e.price(),25,"item price loaded properly"),same(simpleCart.quantity(),1,"sc quantity loaded properly"),same(simpleCart.total(),25,"sc total loaded properly"),same(e.get("thumb"),"http://www.google.com/intl/en_com/images/srpr/logo3w.png","storage non-regular option works")}),test("simpleCart handles corrupt storage",function(){localStorage.setItem("simpleCart_items","%%%%%%%%"),simpleCart.load()}),module("simpleCart core functions"),test("adding and removing items",function(){simpleCart.empty(),same(simpleCart.quantity(),0,"Quantity correct after one item added");var e=simpleCart.add({name:"Cool T-shirt",price:25});same(simpleCart.quantity(),1,"Quantity correct after one item added"),same(simpleCart.total(),25,"Total correct after one item added"),same(e.get("price"),25,"Price is correctly saved"),same(e.get("name"),"Cool T-shirt","Name is correctly saved");var t=simpleCart.add({name:"Really Cool T-shirt",price:"25.99"}),a=simpleCart.find();same(a.length,2,"new items being recognized"),ok(t.equals(t),"same items are .equal"),ok(!t.equals(e),"no false positives on item.equal"),same(t.price(),25.99,"Price as string works");var i=simpleCart.add({name:"Reeeeeally Cool Sweatshirt",UUID:"xxxfdajfdsf823jf92j9fj9f23",price:"$36"});same(i.price(),36,"Price with dollar sign in front is parsed correctly"),simpleCart.empty();var r=simpleCart.add({name:"RaceCar",quantity:1.4342});same(r.quantity(),1,"Item quantity parsed as INT and not decimal"),same(simpleCart.quantity(),1,"SimpleCart quantity parsed as INT and not decimal")}),test("editing items",function(){simpleCart.empty();var e=simpleCart.add({name:"Cool T-shirt",price:25});e.set("name","Really Cool Shorts"),e.set("quantity",2),same(e.get("name"),"Really Cool Shorts","Name attribute updated with .set"),same(e.get("quantity"),2,"quantity updated with .set"),e.quantity(2),same(e.quantity(),2,"Setting quantity with item.quantity() works"),e.increment(),same(simpleCart.quantity(),3,"Quantity is two after item incremented"),same(e.quantity(),3,"Item quantity incremented to 2"),same(simpleCart.total(),75,"Total increased properly after incremented item"),e.increment(5),same(e.quantity(),8,"Quantity incremented with larger value"),e.remove(),same(simpleCart.quantity(),0,"Quantity correct after item removed"),same(simpleCart.total(),0,"Total correct after item removed")}),test("simpleCart.chunk() function works",function(){var e="1111111111111111111111111",t=["11111","11111","11111","11111","11111"];test=simpleCart.chunk(e,5),same(test,t,"chunked array properly into 5 piece chunks")}),test("simpleCart.toCurrency() function works",function(){var e=2234.23;same(simpleCart.toCurrency(e),"&#36;2,234.23","Currency Base Case"),same(simpleCart.toCurrency(e,{delimiter:" "}),"&#36;2 234.23","Changing Delimiter"),same(simpleCart.toCurrency(e,{delimiter:"&thinsp;"}),"&#36;2&thinsp;234.23","Multi Character Delimiter"),same(simpleCart.toCurrency(e,{decimal:","}),"&#36;2,234,23","Changing decimal delimiter"),same(simpleCart.toCurrency(e,{symbol:"!"}),"!2,234.23","Changing currency symbol"),same(simpleCart.toCurrency(e,{accuracy:1}),"&#36;2,234.2","Changing decimal accuracy"),same(simpleCart.toCurrency(e,{after:!0}),"2,234.23&#36;","Changing symbol location"),same(simpleCart.toCurrency(e,{symbol:"",accuracy:0,delimiter:""}),"2234","Long hand toInt string")}),test("simpleCart.each() function works",function(){function e(){var e=!0;return simpleCart.each(i,function(t,a,i){"extra"===i&&(e=!1)}),e}function t(){var e=!0;return simpleCart.each(r,function(t,a){4===a&&(e=!1)}),e}function a(){var e="";return simpleCart.each(i,function(t,a,i){e+=i}),e}Object.prototype.extra=function(){},Array.prototype.awesome=function(){};var i={bob:4,joe:2,bill:function(){},jeff:9},r=["bob","joe","bill","jeff"];ok(e(),"prototype attrs dismissed for object "),ok(t(),"prototype attrs dismissed for array "),same(a(),"bobjoebilljeff","items iterated properly")}),asyncTest("simpleCart.ready() works",function(){simpleCart.ready(function(){ok(!0),start()})}),test("simpleCart.copy() function works",function(){var e=simpleCart.copy("sc_demo");e.add({name:"bob",price:34,size:"big"})}),module("Events"),test("Event return values work",function(){simpleCart.empty(),simpleCart.bind("beforeAdd",function(e){return"do not add"===e.get("special_value")?!1:void 0}),simpleCart.add({name:"neat thing",price:4,special_value:"do not add"}),same(simpleCart.quantity(),0,"Returning false on 'beforeAdd' event prevents item from being added to the cart"),simpleCart.empty(),simpleCart.bind("beforeRemove",function(e){return"do not remove"===e.get("special_value")?!1:void 0});var e=simpleCart.add({name:"thing",price:3,special_value:"do not remove"});e.remove(),same(simpleCart.quantity(),1,"Returning false on 'beforeRemove' event prevents item from being removed."),simpleCart.empty(),same(simpleCart.quantity(),1,"Empty does not clear when beforeRemove prevents items from being removed"),e.set("special_value","hullo")}),test("Add item on load is quiet",function(){simpleCart.empty();var e=!0,t=!0;simpleCart.add({name:"yo",price:1}),simpleCart.bind("beforeAdd",function(t){e=!1}),simpleCart.bind("afterAdd",function(e){t=!1}),simpleCart.load(),ok(e,"beforeAdd event is not called on load"),ok(t,"afterAdd event is not called on load")}),test(".on works",function(){simpleCart.empty();var e=!1;simpleCart.on("beforeAdd",function(){e=!0}),simpleCart.add({name:"thing",price:4}),ok(e,".on() alias for .bind() works")}),test("bind multiple events at once",function(){simpleCart.empty();var e=0,t=0;simpleCart.on("beforeAdd afterAdd",function(){e++}),simpleCart.on("beforeAdd   afterAdd",function(){t++}),simpleCart.add({name:"thing",price:4}),same(e,2,"binding to space seperated list of event names works"),same(t,2,"binding to space seperated list (w/ several spaces) of event names works")}),module("tax and shipping"),test("shipping works",function(){simpleCart.empty(),simpleCart({taxRate:.06,shippingFlatRate:20}),simpleCart.add({name:"bob",price:2}),same(simpleCart.taxRate(),.06,"Tax Rate saved properly"),same(simpleCart.tax(),.12,"Tax Cost Calculated properly"),same(simpleCart.shipping(),20,"Flat Rate shipping works"),simpleCart({shippingQuantityRate:3}),same(simpleCart.shipping(),23,"Shipping Quantity Rate works"),simpleCart({shippingTotalRate:.1}),same(simpleCart.shipping(),23.2,"Shipping Quantity Rate works"),simpleCart({shippingFlatRate:0,shippingQuantityRate:0,shippingTotalRate:0,taxRate:0,shippingCustom:function(){return 45}}),simpleCart.empty(),same(simpleCart.shipping(),45,"Custom Shipping works"),simpleCart.add({name:"cool",price:1,shipping:45}),same(simpleCart.shipping(),90,"item shipping field works"),simpleCart.Item._.shipping=function(){return"cool"===this.get("name")?5:1},simpleCart.empty(),simpleCart.add({name:"cool",price:2}),simpleCart.add({name:"bob",price:3}),simpleCart.add({name:"weird",price:3}),simpleCart({shippingCustom:null}),same(simpleCart.shipping(),7,"Item shipping prototype function works")}),test("tax works",function(){simpleCart.empty(),simpleCart({taxRate:.06}),simpleCart.add({name:"bob",price:2}),same(simpleCart.taxRate(),.06,"Tax Rate saved properly"),same(simpleCart.tax(),.12,"Tax Cost Calculated properly"),simpleCart({shippingFlatRate:0,shippingQuantityRate:0,shippingTotalRate:0,shippingCustom:function(){return 5},taxShipping:!0}),same(simpleCart.tax(),.06*(simpleCart.shipping()+simpleCart.total()),"taxShipping works correctly"),simpleCart({taxShipping:!1}),simpleCart({taxRate:0}),simpleCart.empty(),simpleCart.add({name:"cool",price:2,taxRate:.05}),same(simpleCart.tax(),.1,"Individual item tax rate works"),simpleCart.empty(),simpleCart.add({name:"cool",price:2,tax:1}),same(simpleCart.tax(),1,"Individual item tax cost works"),simpleCart.empty(),simpleCart.add({name:"cool",price:2,tax:function(){return.1*this.price()}}),same(simpleCart.tax(),.2,"individual tax cost function works"),simpleCart.empty()}),test("tax and shipping send to paypal",function(){simpleCart({taxRate:.5}),simpleCart.shipping(function(){return 5.55555}),simpleCart.empty(),simpleCart.add({name:"cool thing with weird price",price:111.1111111111}),simpleCart({checkout:{type:"PayPal",email:"you@yours.com"}}),simpleCart.bind("beforeCheckout",function(e){return same(e.amount_1,(1*e.amount_1).toFixed(2),"Item price is correctly formatted before going to paypal"),same(e.tax_cart,(1*e.tax_cart).toFixed(2),"Tax is correctly formated before going to paypal"),same(e.handling_cart,(1*e.handling_cart).toFixed(2),"Shipping is correctly formated before going to paypal"),!1}),simpleCart.checkout()}),module("simpleCart.find"),test("simpleCart.find() function works",function(){simpleCart.empty();var e=simpleCart.add({name:"bob",price:2,color:"blue",size:6}),t=simpleCart.add({name:"joe",price:3,color:"orange",size:3}),a=simpleCart.add({name:"jeff",price:4,color:"blue",size:4}),i=(simpleCart.add({name:"bill",price:5,color:"red",size:5}),simpleCart.find({color:"orange"})),r=simpleCart.find({price:">=4"}),n=simpleCart.find({size:"<5"}),s=simpleCart.find({name:"bob"}),m=simpleCart.find({color:"blue",size:">4"});same(simpleCart.find(e.id()).id(),e.id(),"Searching with id works"),same(i[0].id(),t.id(),"Searching with string = val works"),same(r[0].id(),a.id(),"Searching >= works"),same(n[0].id(),t.id(),"Searching < works"),same(s[0].id(),e.id(),"Searching by name works"),same(m[0].id(),e.id(),"Searching on multiple indices works")}),test("basic outlets work",function(){simpleCart.add({name:"Cool T-shirt",price:25});document.getElementById("test_id").innerHTML=simpleCart.quantity(),same(document.getElementById("simpleCart_quantity").innerHTML,document.getElementById("test_id").innerHTML,"quantity outlet works"),document.getElementById("test_id").innerHTML=simpleCart.toCurrency(simpleCart.total()),same(document.getElementById("simpleCart_total").innerHTML,document.getElementById("test_id").innerHTML,"total outlet works"),document.getElementById("test_id").innerHTML=simpleCart.taxRate().toFixed(),same(document.getElementById("simpleCart_taxRate").innerHTML,document.getElementById("test_id").innerHTML,"taxRate outlet works"),document.getElementById("test_id").innerHTML=simpleCart.toCurrency(simpleCart.tax()),same(document.getElementById("simpleCart_tax").innerHTML,document.getElementById("test_id").innerHTML,"tax outlet works"),document.getElementById("test_id").innerHTML=simpleCart.toCurrency(simpleCart.shipping()),same(document.getElementById("simpleCart_shipping").innerHTML,document.getElementById("test_id").innerHTML,"shipping outlet works"),document.getElementById("test_id").innerHTML=simpleCart.toCurrency(simpleCart.grandTotal()),same(document.getElementById("simpleCart_grandTotal").innerHTML,document.getElementById("test_id").innerHTML,"grand total outlet works")}),test("basic outlets work",function(){simpleCart.add({name:"Cool T-shirt",price:25});document.getElementById("test_id").innerHTML=simpleCart.quantity(),same(document.getElementById("simpleCart_quantity").innerHTML,document.getElementById("test_id").innerHTML,"quantity outlet works"),document.getElementById("test_id").innerHTML=simpleCart.toCurrency(simpleCart.total()),same(document.getElementById("simpleCart_total").innerHTML,document.getElementById("test_id").innerHTML,"total outlet works"),document.getElementById("test_id").innerHTML=simpleCart.taxRate().toFixed(),same(document.getElementById("simpleCart_taxRate").innerHTML,document.getElementById("test_id").innerHTML,"taxRate outlet works"),document.getElementById("test_id").innerHTML=simpleCart.toCurrency(simpleCart.tax()),same(document.getElementById("simpleCart_tax").innerHTML,document.getElementById("test_id").innerHTML,"tax outlet works"),document.getElementById("test_id").innerHTML=simpleCart.toCurrency(simpleCart.shipping()),same(document.getElementById("simpleCart_shipping").innerHTML,document.getElementById("test_id").innerHTML,"shipping outlet works"),document.getElementById("test_id").innerHTML=simpleCart.toCurrency(simpleCart.grandTotal()),same(document.getElementById("simpleCart_grandTotal").innerHTML,document.getElementById("test_id").innerHTML,"grand total outlet works")}),simpleCart.empty(),simpleCart.add({name:"Cool T-shirt",price:25,thumb:"http://www.google.com/intl/en_com/images/srpr/logo3w.png"});