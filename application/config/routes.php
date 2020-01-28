<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/*

| -------------------------------------------------------------------------

| URI ROUTING

| -------------------------------------------------------------------------

| This file lets you re-map URI requests to specific controller functions.

|

| Typically there is a one-to-one relationship between a URL string

| and its corresponding controller class/method. The segments in a

| URL normally follow this pattern:

|

|	example.com/class/method/id/

|

| In some instances, however, you may want to remap this relationship

| so that a different class/function is called than the one

| corresponding to the URL.

|

| Please see the user guide for complete details:

|

|	https://codeigniter.com/user_guide/general/routing.html

|

| -------------------------------------------------------------------------

| RESERVED ROUTES

| -------------------------------------------------------------------------

|

| There are three reserved routes:

|

|	$route['default_controller'] = 'welcome';

|

| This route indicates which controller class should be loaded if the

| URI contains no data. In the above example, the "welcome" class

| would be loaded.

|

|	$route['404_override'] = 'errors/page_missing';

|

| This route will tell the Router which controller/method to use if those

| provided in the URL cannot be matched to a valid route.

|

|	$route['translate_uri_dashes'] = FALSE;

|

| This is not exactly a route, but allows you to automatically route

| controller and method names that contain dashes. '-' isn't a valid

| class or method name character, so it requires translation.

| When you set this option to TRUE, it will replace ALL dashes in the

| controller and method URI segments.

|

| Examples:	my-controller/index	-> my_controller/index

|		my-controller/my-method	-> my_controller/my_method

*/

$route['default_controller'] = 'Main';

$route['404_override'] = '';

$route['translate_uri_dashes'] = FALSE;



// Standard Main Controller Routes

$route['login'] = 'Main/login';

$route['register'] = 'Main/register';

$route['guestlogin'] = 'Main/guestLogin';

$route['dashboard'] = 'Main/dashboard';	

$route['aboutus'] = 'Main/aboutus';

$route['refundCancle'] = 'Main/refundCancle';

$route['contactus'] = 'Main/contactus';

$route['career'] = 'Main/career';

$route['order'] = 'Main/order';

$route['faq'] = 'Main/faq';

$route['terms'] = 'Main/terms';

$route['sitemap'] = 'Main/sitemap';

$route['corporate'] = 'Main/corporate';

$route['franchise'] = 'Main/franchise';

$route['privacypolicy'] = 'Main/privacy';

$route['trackorder'] = 'Main/trackOrder';

$route['myprofile'] = 'Main/updateProfile';

$route['thankyou'] = 'Main/thankyou';



$route['corporatecatalogue'] = 'Main/corporatecatalogue';



// Routes for Shop

$route['checkout'] = 'ShopSection/checkout';

$route['user/saveaddress'] = 'ShopSection/saveAddress';

$route['user/addressform'] = 'ShopSection/getBillAddress';

$route['user/addressshipform'] = 'ShopSection/getShipAddress';

$route['user/addressship'] = 'ShopSection/getShipA';

$route['user/addressbill'] = 'ShopSection/getBillA';

$route['user/confirmorder'] = 'ShopSection/confirmOrder';

$route['user/orderpage'] = 'ShopSection/orders';

$route['user/resumecart'] = 'ShopSection/resumeCart';

$route['oldsearch'] = 'ShopSection/searchProduct';

$route['search'] = 'SearchController/searchProduct';

$route['searching/loadlist'] = 'SearchController/searchList';



$route['order/payment'] = 'ShopSection/confirmPayment';

$route['user/saveshipaddress'] = 'ShopSection/saveShipAddress';

$route['user/clearcart'] = 'ShopSection/clearCart';

$route['user/removeitemcart'] = 'ShopSection/removeCart';

$route['cart/applycoupon'] = 'ShopSection/applyCoupon';

$route['cart/addtocart'] = 'ShopSection/addoncart';

$route['cart/getAddonsProducts'] = 'ShopSection/getAddonsProducts';

$route['product/timeslotpick'] = 'ShopSection/getTimeSlots';

$route['product/shipratepick'] = 'ShopSection/getShipRates';

$route['compare'] = 'ShopSection/compare';

$route['(:any)/c(:num)'] = 'ShopSection/ProductCategory/$2/$1';

$route['(:any)/(:any)/cc(:num)'] = 'ShopSection/ProductChildCategory/$3/$2/$1';

$route['(:any)/cc(:num)'] = 'ShopSection/ProductChildCategory/$2/$1';

$route['(:any)/ct(:num)'] = 'CitiesController/ProductCities/$2/$1';

$route['(:any)/p(:num)'] = 'ShopSection/productDetail/$2/$1';

$route['cakedetail'] = 'ShopSection/cakeDetail';

$route['mycart'] = 'ShopSection/myCart';

$route['wishlist'] = 'ShopSection/wishlist';

$route['walletTransaction'] = 'ShopSection/walletTransaction';

$route['review/submit'] = 'ShopSection/insertReview';

$route['product/compare'] = 'ShopSection/addCompareProduct';

$route['product/wish'] = 'ShopSection/addWishlistProduct';

$route['product/cart'] = 'ShopSection/addCartProduct';

$route['product/quickview'] = 'ShopSection/quickViewProduct';

$route['product/comparebox'] = 'ShopSection/getCompareBox';

$route['product/loadlist'] = 'ShopSection/loadProductList';

$route['getpricebox'] = 'ShopSection/getPriceBox';



$route['AvailablePincode'] = 'ShopSection/getCityByPincode';

// Routes for Blogs

$route['blog'] = 'BlogSection/blog';

$route['blog/(:num)/(:any)'] = 'BlogSection/singleBlog/$1/$2';

$route['blog/category/(:num)/(:any)'] = 'BlogSection/categoryBlog/$1/$2';

$route['blog/commentsubmit'] = 'BlogSection/insertComment';



// Routes for UserSection

$route['user/Create'] = 'UserSection/createUser';

$route['user/login'] = 'UserSection/loginUser';

$route['user/logout'] = 'UserSection/logoutUser';

$route['logout'] = 'UserSection/logoutUser';

$route['user/googleauth'] = 'UserSection/googleAuth';

$route['user/facebookauth'] = 'UserSection/facebookAuth';

$route['user/Corporate'] = 'UserSection/sendToCorporate';

$route['user/Franchise'] = 'UserSection/sendToFranchise';

$route['guest/login'] = 'UserSection/guestLogin';

$route['user/forgotpass'] = 'UserSection/forgotPassword';

$route['update/changecontact']['post'] = 'UserSection/changeContact';



// Routes for Vendor

$route['vendor'] = 'vendor/VendorMain/loginPage';

$route['vendor/dashboard'] = 'vendor/VendorMain/dashboard';

$route['vendor/changepass'] = 'vendor/VendorMain/changePassword';

$route['vendor/statement'] = 'vendor/VendorMain/viewStatement';

$route['vendor/loginsubmit'] = 'vendor/VendorMain/vendorLogin';

$route['vendor/orderrequests'] = 'vendor/VendorMain/orderRequests';

$route['vendor/logout'] = 'vendor/VendorMain/vendorLogOut';

$route['vendor/requesttable'] = 'vendor/VendorMain/orderRequestTable';

$route['vendor/getorderdetails'] = 'vendor/VendorMain/orderDetail';

$route['vendor/updaterequest'] = 'vendor/VendorMain/updateRequest';

$route['vendor/acceptedtable'] = 'vendor/VendorMain/acceptedOrders';

$route['vendor/deliveredtable'] = 'vendor/VendorMain/deliveredOrders';

$route['vendor/myorders'] = 'vendor/VendorMain/acceptedOrderPage';

$route['vendor/mydeliveredorders'] = 'vendor/VendorMain/deliveredOrderPage';

$route['vendor/updateOrderStatus'] = 'vendor/VendorMain/updateOrderStatus';

$route['vendor/forgotpass'] = 'vendor/VendorMain/forgotPassword';

$route['vendor/citylist'] = 'vendor/VendorMain/getCityList';



// Routes for Admin

$route['admin/dashboard'] = 'admin/AdminMain/dashboard';

$route['admin'] = 'admin/AdminMain/login';

$route['admin/addAboutUs'] = 'admin/AdminMain/aboutUsPage';

$route['admin/addTerms'] = 'admin/AdminMain/addTermsPage';

$route['admin/addBanners'] = 'admin/AdminMain/addBannersPage';

$route['admin/addCategory'] = 'admin/AdminMain/addCategoryPage';

$route['admin/addAddonCategory'] = 'admin/AdminMain/addAddonCategoryPage';

$route['admin/addSubCategory'] = 'admin/AdminMain/addSubCategoryPage';

$route['admin/addChildCategory'] = 'admin/AdminMain/addChildCategoryPage';

$route['admin/addProduct'] = 'admin/AdminMain/addProductPage';

$route['admin/sortProduct']['get'] = 'admin/AdminMain/sortProductPage';

$route['admin/homeSort']['get'] = 'admin/ProductController/homeSortPage';

$route['admin/sortProduct']['post'] = 'admin/AdminMain/sortingProducts';

$route['admin/homeSort']['post'] = 'admin/ProductController/homeSort';

$route['admin/addProduct/(:any)'] = 'admin/AdminMain/addProductPage/$1';

$route['admin/viewProduct'] = 'admin/AdminMain/viewProductPage';

$route['admin/availStates'] = 'admin/AdminMain/availStatesPage';

$route['admin/availCities'] = 'admin/AdminMain/availCitiesPage';

$route['admin/availPincodes'] = 'admin/AdminMain/availPincodesPage';

$route['admin/addDiscount'] = 'admin/AdminMain/addDiscountPage';

$route['admin/addDiscount/(:num)'] = 'admin/AdminMain/addDiscountPage/$1';

// $route['admin/applyDiscount'] = 'admin/AdminMain/applyDiscountPage';

$route['admin/viewOrders'] = 'admin/AdminMain/viewOrderPage';

$route['admin/pendingOrders'] = 'admin/AdminMain/viewPendingOrderPage';

$route['admin/forwardedOrders'] = 'admin/AdminMain/viewForwardedOrderPage';

$route['admin/acceptedOrders'] = 'admin/AdminMain/viewAcceptedOrderPage';

$route['admin/shippedOrders'] = 'admin/AdminMain/viewShippedOrderPage';

$route['admin/deliveredOrders'] = 'admin/AdminMain/viewDeliveredOrderPage';

$route['admin/addVendor'] = 'admin/AdminMain/addVendorPage';

$route['admin/addVendor/(:num)'] = 'admin/AdminMain/addVendorPage/$1';

$route['admin/viewVendors'] = 'admin/AdminMain/viewVendorPage';

$route['admin/customers'] = 'admin/AdminMain/allCustomersPage';

$route['admin/addBlog'] = 'admin/AdminMain/addBlogPage';

$route['admin/addBlog/(:num)'] = 'admin/AdminMain/addBlogPage/$1';

$route['admin/viewBlogs'] = 'admin/AdminMain/viewBlogsPage';

$route['admin/blog/category'] = 'admin/AdminMain/addBlogCategory';

$route['admin/loginsubmit'] = 'admin/AdminMain/loginSubmit';

$route['admin/logout'] = 'admin/AdminMain/logOut';

$route['admin/addSpecials'] = 'admin/AdminMain/addSpecials';

$route['admin/addshippings'] = 'admin/AdminMain/shippingTypes';

$route['admin/addtimeslots'] = 'admin/AdminMain/timeSlots';

$route['admin/corporateOrder'] = 'admin/AdminMain/corporateOrder';

$route['admin/cancelledorder'] = 'admin/AdminMain/cancelledOrderPage';

$route['admin/customers'] = 'admin/AdminMain/allCustomersPage';

$route['admin/refundWallet'] = 'admin/AdminMain/refundToWalletPage';

$route['admin/refundBank'] = 'admin/AdminMain/refundToBankPage';

$route['admin/addRefCan'] = 'admin/AdminMain/cancellationPage';

$route['admin/privacyPage'] = 'admin/AdminMain/privacyPage';

// Routes for Data Insert of Admin (AdminFunction)

$route['admin/customerdetail'] = 'admin/AdminFunction/CustomerDetailTable';

$route['admin/cancelledorderstable'] = 'admin/AdminFunction/cancelledOrderTable';

$route['admin/refundOrder'] = 'admin/AdminFunction/refundOrder';

$route['admin/userinfo'] = 'admin/AdminFunction/getUserInfo';

$route['admin/vendorinfo'] = 'admin/AdminFunction/getVendorInfo';

$route['admin/vendorwiseorder'] = 'admin/AdminFunction/vendorWiseOrder';

$route['admin/insertcat'] = 'admin/AdminFunction/insertCategory';

$route['admin/insertaddoncat'] = 'admin/AdminFunction/insertAddonCategory';

$route['admin/cattable'] = 'admin/AdminFunction/viewCategoryTable';

$route['admin/addoncattable'] = 'admin/AdminFunction/viewAddonCategoryTable';

$route['admin/transferCategory'] = 'admin/ProductController/category_transfer';

$route['admin/catTransferApply'] = 'admin/ProductController/apply_transfer_category';

$route['admin/editcat'] = 'admin/AdminFunction/editCategory';

$route['admin/editbanner'] = 'admin/AdminFunction/editBanner';

$route['admin/deletecat'] = 'admin/AdminFunction/deleteCategory';

$route['admin/deleteAddoncat'] = 'admin/AdminFunction/deleteAddonCategory';

$route['admin/insertpincode'] = 'admin/AdminFunction/insertPincode';

$route['admin/pincodetable/(:num)'] = 'admin/AdminFunction/viewPincodeTable/$1';

$route['admin/editpincode'] = 'admin/AdminFunction/editPincode';

$route['admin/deletepincode'] = 'admin/AdminFunction/deletePincode';

$route['admin/insertbanner'] = 'admin/AdminFunction/insertBanner';

$route['admin/bantable'] = 'admin/AdminFunction/viewBannerTable';

$route['admin/updateban'] = 'admin/AdminFunction/updateBanner';

$route['admin/insertstate'] = 'admin/AdminFunction/insertState';

$route['admin/statetable'] = 'admin/AdminFunction/viewStateTable';

$route['admin/editstate'] = 'admin/AdminFunction/editState';

$route['admin/deletestate'] = 'admin/AdminFunction/deleteState';

$route['admin/citylist'] = 'admin/AdminFunction/getCityList';

$route['admin/statecitylist'] = 'admin/AdminFunction/getStateCityList';

$route['admin/citytable'] = 'admin/AdminFunction/viewCityTable';

$route['admin/insertcity'] = 'admin/AdminFunction/insertCity';

$route['admin/editcity'] = 'admin/AdminFunction/editCity';

$route['admin/deletecity'] = 'admin/AdminFunction/deleteCity';

$route['admin/addvendor'] = 'admin/AdminFunction/addVendor';

$route['admin/editvendor'] = 'admin/AdminFunction/editVendor';

$route['admin/changevendorstat'] = 'admin/AdminFunction/changeVendorStat';

$route['admin/vendortable'] = 'admin/AdminFunction/viewVendorTable';

$route['admin/subcattable'] = 'admin/AdminFunction/viewSubcatTable';

$route['admin/insertsubcat'] = 'admin/AdminFunction/addSubcategory';

$route['admin/editsubcat'] = 'admin/AdminFunction/editSubcat';

$route['admin/deletesubcat'] = 'admin/AdminFunction/deleteSubcat';

$route['admin/childcattable'] = 'admin/AdminFunction/viewChildcatTable';

$route['admin/subcatlist'] = 'admin/AdminFunction/getSubCatList';

$route['admin/selectedSubcatlist'] = 'admin/AdminFunction/getSelectedSubCatList';

$route['admin/childcatlist'] = 'admin/AdminFunction/getChildCatList';

$route['admin/childcatlistData'] = 'admin/AdminFunction/getchildcatlistData';

$route['admin/selectedChildcatlistData'] = 'admin/AdminFunction/getSelectedChildCatList';

$route['admin/productlist'] = 'admin/AdminFunction/getProductlist';

$route['admin/productHomelist'] = 'admin/AdminFunction/getProductHomelist';

$route['admin/subcatlistData'] = 'admin/AdminFunction/getsubcatlistData';

$route['admin/childlistbycat'] = 'admin/AdminFunction/childListbyCat';

$route['admin/productbycat'] = 'admin/AdminFunction/getProductByCat';

$route['admin/productbychild'] = 'admin/AdminFunction/getProductByChild';

$route['admin/insertchildcat'] = 'admin/AdminFunction/addChildcategory';

$route['admin/editchildcat'] = 'admin/AdminFunction/editChildcat';

$route['admin/deletechildcat'] = 'admin/AdminFunction/deleteChildcat';

$route['admin/isdisplaychildcat'] = 'admin/AdminFunction/isdisplaychildcat';

$route['admin/insertproduct'] = 'admin/AdminFunction/insertProduct';

$route['admin/producttable'] = 'admin/AdminFunction/viewProductTable';

$route['admin/insertoffer'] = 'admin/AdminFunction/insertOffer';

$route['admin/updateoffer'] = 'admin/AdminFunction/updateOffer';

$route['admin/modalApplyoffer/(:num)']['get'] = 'admin/DiscountController/getForm/$1';

$route['admin/modalApplyoffer/(:num)']['post'] = 'admin/DiscountController/applyOffer/$1';

$route['admin/offertable'] = 'admin/AdminFunction/viewOfferTable';

// $route['admin/submitoffer'] = 'admin/AdminFunction/offerDetailApply';

$route['admin/insertblog'] = 'admin/AdminFunction/insertBlog';

$route['admin/blogtable'] = 'admin/AdminFunction/viewBlogTable';

$route['admin/updateblog'] = 'admin/AdminFunction/updateBlog';

$route['admin/deleteblog'] = 'admin/AdminFunction/deleteBlog';

$route['admin/blog/insertcat'] = 'admin/AdminFunction/insertBlogCategory';

$route['admin/blog/cattable'] = 'admin/AdminFunction/viewBlogCategoryTable';

$route['admin/blog/editcat'] = 'admin/AdminFunction/editBlogCategory';

$route['admin/blog/deletecat'] = 'admin/AdminFunction/deleteBlogCategory';

$route['admin/site/aboutus'] = 'admin/AdminFunction/updateAboutUs';

$route['admin/site/termspage'] = 'admin/AdminFunction/updateTerms';

$route['admin/site/privacypage'] = 'admin/AdminFunction/updatePrivacy';

$route['admin/insertcharges'] = 'admin/AdminFunction/insertCharges';

$route['admin/chargestable'] = 'admin/AdminFunction/viewChargesTable';

$route['admin/deletecharge'] = 'admin/AdminFunction/deleteCharge';

$route['admin/editcharge'] = 'admin/AdminFunction/editCharge';

$route['admin/setshiprate'] = 'admin/AdminFunction/setShipRate';

$route['admin/deleteslot'] = 'admin/AdminFunction/deleteTimeSlot';

$route['admin/deleteshiprate'] = 'admin/AdminFunction/deleteShipRate';

$route['admin/settimeslot'] = 'admin/AdminFunction/setTimeSlot';

$route['admin/shipratetable'] = 'admin/AdminFunction/viewShipRateTable';

$route['admin/neworderstable'] = 'admin/AdminFunction/viewNewOrdersTable';

$route['admin/orderlisttable'] = 'admin/AdminFunction/ListNewOrdersTable';

$route['admin/pendingorderstable'] = 'admin/AdminFunction/viewPendingOrdersTable';

$route['admin/forwardedordertable'] = 'admin/AdminFunction/viewForwardingOrdersTable';

$route['admin/acceptedorderstable'] = 'admin/AdminFunction/viewAcceptedOrdersTable';

$route['admin/shippedorderstable'] = 'admin/AdminFunction/viewShippedOrdersTable';

$route['admin/deliveredorderstable'] = 'admin/AdminFunction/viewDeliveredOrdersTable';

$route['admin/forwardorderform'] = 'admin/AdminFunction/forwardOrderForm';

$route['admin/assignorder'] = 'admin/AdminFunction/assignOrderToVendor';

$route['admin/acceptbargain'] = 'admin/AdminFunction/approveBargainPrice';

$route['admin/reassignorder'] = 'admin/AdminFunction/reAssignOrder';

$route['admin/bargainorder'] = 'admin/AdminFunction/bargainOrder';

$route['admin/updatepro'] = 'admin/AdminFunction/updateProduct';

$route['admin/insertorder'] = 'admin/AdminFunction/insertCorporateOrder';

$route['admin/timeslottable'] = 'admin/AdminFunction/viewTimeSlotTable';

$route['admin/updateOrderStatus'] = 'admin/AdminFunction/updateOrderStatus';

$route['admin/searchpro'] = 'admin/AdminFunction/searchProduct';

$route['admin/loadextracharge'] = 'admin/AdminFunction/loadExtraCharge';

$route['admin/refundWalletTable'] = 'admin/AdminFunction/refundWalletTable';

$route['admin/refundBankTable'] = 'admin/AdminFunction/refundBankTable';



$route['admin/getIndata/(:any)'] = 'admin/AdminFunction/getCustomINData/$1';



$route['admin/extraSettings'] = 'admin/AdminMain/extraSettings';



$route['admin/tax'] = 'admin/AdminMain/listTax';

$route['admin/taxtable'] = 'admin/AdminMain/tableTax';

$route['admin/formTax/(:any)'] = 'admin/AdminMain/fromTax/$1';

$route['admin/insertTax/(:any)'] = 'admin/AdminFunction/insertTax/$1';

$route['admin/removeTax/(:any)'] = 'admin/AdminFunction/removeTax/$1';

$route['admin/shiftProductForm/(:num)/(:num)']['get'] = 'admin/ProductController/formShiftProduct/$1/$2';

$route['admin/shiftProduct/(:num)/(:num)']['post'] = 'admin/ProductController/storeShifted/$1/$2';

$route['admin/searchproskuname'] = 'admin/ProductController/searchproskuname';



//$route['about_us'] = 'AboutController/index';