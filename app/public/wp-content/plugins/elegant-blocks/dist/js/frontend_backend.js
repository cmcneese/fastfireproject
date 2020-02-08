jQuery(document).ready(function(){

	/*!
	 *  GMAP3 Plugin for jQuery
	 *  Version  : 7.2
	 *  Date     : 2016/12/03
	 *  Author   : DEMONTE Jean-Baptiste
	 *  Contact  : jbdemonte@gmail.com
	 *  Web site : http://gmap3.net
	 *  Licence  : GPL-3.0+
	 */
	!function(n,t,e){"use strict";function o(n){return S(!0,{},n||{})}function r(){var n=Array.prototype.slice,t=n.call(arguments,1);return n.apply(arguments[0],t)}function i(n){return"undefined"==typeof n}function u(t){return O.apply(n,t)}function a(n){return O().then(function(){return n})}function c(n,t){var e=Math,o=e.PI,r=o*n.lat()/180,i=o*n.lng()/180,u=o*t.lat()/180,a=o*t.lng()/180,c=e.cos,s=e.sin;return 6371e3*e.acos(e.min(c(r)*c(u)*c(i)*c(a)+c(r)*s(i)*c(u)*s(a)+s(r)*s(u),1))}function s(n){"loading"!=e.readyState?n():e.addEventListener("DOMContentLoaded",n)}function f(n){return v(n).map(function(t){return encodeURIComponent(t)+"="+encodeURIComponent(n[t])}).join("&")}function p(n){return D[n]||(D[n]=l(n)),D[n]}function l(n){function t(n){return e.apply(this,n)}var e=E[n];return t.prototype=e.prototype,new t(r(arguments,1))}function g(n){var t=$();return"string"==typeof n&&(n={address:n}),p("Geocoder").geocode(n,function(n,e){e===E.GeocoderStatus.OK?t.resolve(n[0].geometry.location):t.reject(e)}),t}function d(n,t){h(n.split(" "),t)}function h(n,t){(R(n)?n:[n]).forEach(t)}function v(n){return Object.keys(n)}function y(n){return v(n).map(function(t){return n[t]})}function m(n,t){return n=o(n),n.bounds&&(n.bounds=P(n.bounds)),a(t(n))}function L(n,t,e){var r=$();return n=o(n),O().then(function(){var e=n.address;return e?(delete n.address,g(e).then(function(e){n[t]=e})):void(n[t]=x(n[t]))}).then(function(){r.resolve(e(n))}).fail(function(n){r.reject(n)}),r}function w(n,t,e){return n=o(n),n[t]=(n[t]||[]).map(x),a(e(n))}function x(n,t){return R(n)?new E.LatLng(n[0],n[1]):!t||!n||n instanceof E.LatLng?n:new E.LatLng(n.lat,n.lng)}function P(n,t){return R(n)?new E.LatLngBounds({lat:n[2],lng:n[3]},{lat:n[0],lng:n[1]}):t&&!n.getCenter?new E.LatLngBounds({lat:n.south,lng:n.west},{lat:n.north,lng:n.east}):n}function b(t,o){function r(){function n(n){return e.getProjection().fromLatLngToDivPixel(n)}var e=this,r=[];i.call(e),e.setMap(t),e.onAdd=function(){var n=e.getPanes();n.overlayMouseTarget.appendChild(u[0])},o.position?(e.getPosition=function(){return o.position},e.setPosition=function(n){o.position=n,e.draw()},e.draw=function(){var t=n(o.position);u.css({left:t.x+o.x+"px",top:t.y+o.y+"px"})}):(e.getBounds=function(){return o.bounds},e.setBounds=function(n){o.bounds=n,e.draw()},e.draw=function(){var t=n(o.bounds.getSouthWest()),e=n(o.bounds.getNorthEast());u.css({left:t.x+o.x+"px",top:e.y+o.y+"px",width:e.x-t.x+o.x+"px",height:t.y-e.y+o.y+"px"})}),e.onRemove=function(){r.map(function(n){E.event.removeListener(n)}),u.remove(),e.$=u=null},e.$=u}var i=E.OverlayView,u=n(e.createElement("div")).css({border:"none",borderWidth:0,position:"absolute"}).append(o.content);return o=S({x:0,y:0},o),o.position?o.position=x(o.position,!0):o.bounds&&(o.bounds=P(o.bounds,!0)),r.prototype=new i,new r}function M(n){function t(){var n=this;return n.onAdd=n.onRemove=n.draw=function(){},E.OverlayView.call(n)}t.prototype=new E.OverlayView;var e=new t;return e.setMap(n),e.getProjection()}function B(n,t,e,o){var r=this;r.cluster=n,r.markers=t,r.$=e.$,r.overlay=e,e.getBounds=function(){return l("LatLngBounds",o.getSouthWest(),o.getNorthEast())}}function C(n,t){function e(){var t=l("Circle",{center:n.getCenter(),radius:1.15*c(n.getCenter(),n.getBounds().getNorthEast())});return t.getBounds()}function i(n){var t=d.fromLatLngToDivPixel(n);return l("LatLngBounds",d.fromDivPixelToLatLng(l("Point",t.x-P,t.y+P)),d.fromDivPixelToLatLng(l("Point",t.x+P,t.y-P)))}function u(){var u,a,c,s,f,p,d=n.getZoom(),y={},x=[],P={};p=""+d,d>3&&(a=e(),h(w,function(n,t){a.contains(n.getPosition())||(p+="-"+t,P[t]=!0,n.getMap()&&n.setMap(null))})),m&&h(w,function(n,t){P[t]||m(n)||(p+="-"+t,P[t]=!0,n.getMap()&&n.setMap(null))}),p!==g&&(g=p,h(w,function(e,p){P[p]||(u=[p],a=i(e.getPosition()),C&&h(r(w,p+1),function(n,t){t+=p+1,!P[t]&&a.contains(n.getPosition())&&(u.push(t),P[t]=!0)}),s=u.join("-"),y[s]=!0,T[s]||(f=u.map(function(n){return w[n]}),c=t.cb(r(f)),c?(a=l("LatLngBounds"),h(f,function(n){a.extend(n.getPosition()),n.getMap()&&n.setMap(null)}),c=o(c),c.position=a.getCenter(),T[s]=new B(L,r(f),b(n,c),a),x.push(T[s])):h(f,function(t){t.getMap()||t.setMap(n)})))}),h(v(T),function(n){y[n]||(T[n].overlay.setMap(null),delete T[n])}),x.length&&h(k,function(n){n(x)}))}function a(){clearTimeout(f),f=setTimeout(u,100)}function s(){E.event.addListener(n,"zoom_changed",a),E.event.addListener(n,"bounds_changed",a),u()}var f,p,g,d,m,L=this,w=[],P=(t.size||200)>>1,C=!0,T={},k=[];t=t||{},t.markers=t.markers||[],L._b=function(n){n(y(T)),k.push(n)},L.markers=function(){return r(w)},L.groups=function(){return y(T)},L.enable=function(){C||(C=!0,g="",a())},L.disable=function(){C&&(C=!1,g="",a())},L.add=function(n){w.push(n),g="",a()},L.remove=function(n){w=w.filter(function(t){return t!==n}),g="",a()},L.filter=function(n){m!==n&&(m=n,g="",a())},t.markers.map(function(n){n.position=x(n.position),w.push(l("Marker",n))}),p=setInterval(function(){d=M(n),d&&(clearInterval(p),s())},10)}function T(n,t){var e=this;v(t[0]).forEach(function(n){e[n]=function(){var o=[],i=r(arguments);return t.forEach(function(t){o.push(t[n].apply(t,i))}),"get"===n?o.length>1?o:o[0]:e}}),e.$=n}function k(t,e){function c(){return{$:t,get:M.get}}function s(t,e,o,i){var u=arguments.length>3;u||(i=o),n.each(t,function(n,t){h(e,function(e){var a=e instanceof B,s=a||e instanceof E.OverlayView,f=s?e.$.get(0):e;E.event["add"+(s?"Dom":"")+"Listener"+(i?"Once":"")](f,n,function(n){h(t,function(t){if(A(t))if(a)t.call(c(),void 0,e,e.cluster,n);else if(u){var i=r(o);i.unshift(e),i.push(n),t.apply(c(),i)}else t.call(c(),e,n)})})})})}function f(n){return function(t){if(R(t)){var e=[],o=t.map(function(t){return n.call(M,t).then(function(n){e.push(n)})});return u(o).then(function(){return y.push(e),e})}return n.apply(M,arguments).then(function(n){return y.push(n),n})}}function g(n){return function(){var t=r(arguments);return P=P.then(function(e){return A(t[0])?O(t[0].call(c(),e)).then(function(e){return t[0]=e,n.apply(M,t)}):O(n.apply(M,t))})}}var v,y=[],P=O(),M=this;M.map=g(function(n){return v||L(n,"center",function(n){return v=l("Map",t.get(0),n),y.push(v),v})}),d("Marker:position Circle:center InfoWindow:position:0 Polyline:path Polygon:paths",function(n){n=n.split(":");var t=n[1]||"";M[n[0].toLowerCase()]=g(f(function(e){return(t.match(/^path/)?w:L)(e,t,function(t){return"0"!==n[2]&&(t.map=v),l(n[0],t)})}))}),d("TrafficLayer TransitLayer BicyclingLayer",function(n){M[n.toLowerCase()]=g(function(){var t=l(n);return y.push(t),t.setMap(v),t})}),M.kmllayer=g(f(function(n){return n=o(n),n.map=v,O(l("KmlLayer",n))})),M.rectangle=g(f(function(n){return m(n,function(n){return n.map=v,l("Rectangle",n)})})),M.overlay=g(f(function(n){function t(n){return b(v,n)}return n=o(n),n.bounds?m(n,t):L(n,"position",t)})),M.groundoverlay=g(function(n,t,e){return m({bounds:t},function(t){e=o(e),e.map=v;var r=l("GroundOverlay",n,t.bounds,e);return y.push(r),r})}),M.styledmaptype=g(function(n,t,e){var o=l("StyledMapType",t,e);return y.push(o),v.mapTypes.set(n,o),o}),M.streetviewpanorama=g(function(t,e){return L(e,"position",function(e){var o=l("StreetViewPanorama",n(t).get(0),e);return v.setStreetView(o),y.push(o),o})}),M.route=g(function(n){var t=$();return n=o(n),n.origin=x(n.origin),n.destination=x(n.destination),p("DirectionsService").route(n,function(n,e){y.push(n),t.resolve(e===E.DirectionsStatus.OK?n:!1)}),t}),M.cluster=g(function(n){var t=new C(v,o(n));return y.push(t),a(t)}),M.directionsrenderer=g(function(t){var e;return t&&(t=o(t),t.map=v,t.panel&&(t.panel=n(t.panel).get(0)),e=l("DirectionsRenderer",t)),y.push(e),e}),M.latlng=g(f(function(n){return L(n,"latlng",function(n){return y.push(n.latlng),n.latlng})})),M.fit=g(function(){var n=l("LatLngBounds");return h(y,function(t){t!==v&&h(t,function(t){t&&(t.getPosition&&t.getPosition()?n.extend(t.getPosition()):t.getBounds&&t.getBounds()?(n.extend(t.getBounds().getNorthEast()),n.extend(t.getBounds().getSouthWest())):t.getPaths&&t.getPaths()?h(t.getPaths().getArray(),function(t){h(t.getArray(),function(t){n.extend(t)})}):t.getPath&&t.getPath()?h(t.getPath().getArray(),function(t){n.extend(t)}):t.getCenter&&t.getCenter()&&n.extend(t.getCenter()))})}),n.isEmpty()||v.fitBounds(n),!0}),M.wait=function(n){P=P.then(function(t){var e=$();return setTimeout(function(){e.resolve(t)},n),e})},M.then=function(n){A(n)&&(P=P.then(function(t){return O(n.call(c(),t)).then(function(n){return i(n)?t:n})}))},M["catch"]=function(n){A(n)&&(P=P.then(null,function(t){return O(n.call(c(),t))}))},d("on once",function(n,t){M[n]=function(){var n=arguments[0];n&&("string"==typeof n&&(n={},n[arguments[0]]=r(arguments,1)),P.then(function(e){if(e){if(e instanceof C)return e._b(function(e){e&&e.length&&s(n,e,t)}),s(n,e.markers(),[void 0,e],t);s(n,e,t)}}))}}),M.get=function(n){return i(n)?y.map(function(n){return R(n)?n.slice():n}):(0>n&&(n=y.length+n),R(y[n])?y[n].slice():y[n])},e&&M.map(e)}var E,j,D={},O=n.when,S=n.extend,R=n.isArray,A=n.isFunction,$=n.Deferred;O(function(){var o,r=$(),i="__gmap3";return n.holdReady(!0),s(function(){t.google&&t.google.maps||j===!1?r.resolve():(t[i]=function(){delete t[i],r.resolve()},o=e.createElement("script"),o.type="text/javascript",o.src="https://maps.googleapis.com/maps/api/js?callback="+i+(j?"&"+("string"==typeof j?j:f(j)):""),n("head").append(o))}),r}()).then(function(){n.holdReady(!1)}),n.gmap3=function(n){j=n},n.fn.gmap3=function(e){var o=[];return E=t.google.maps,this.each(function(){var t=n(this),r=t.data("gmap3");r||(r=new k(t,e),t.data("gmap3",r)),o.push(r)}),new T(this,o)}}(jQuery,window,document);

	/**
	 * @name MarkerClusterer for Google Maps v3
	 * @version version 1.0
	 * @author Luke Mahe
	 * @fileoverview
	 * The library creates and manages per-zoom-level clusters for large amounts of
	 * markers.
	 * <br/>
	 * This is a v3 implementation of the
	 * <a href="http://gmaps-utility-library-dev.googlecode.com/svn/tags/markerclusterer/"
	 * >v2 MarkerClusterer</a>.
	 */

	function MarkerClusterer(t,e,r){this.extend(MarkerClusterer,google.maps.OverlayView),this.map_=t,this.markers_=[],this.clusters_=[],this.sizes=[53,56,66,78,90],this.styles_=[],this.ready_=!1;var s=r||{};this.gridSize_=s.gridSize||60,this.minClusterSize_=s.minimumClusterSize||2,this.maxZoom_=s.maxZoom||null,this.styles_=s.styles||[],this.imagePath_=s.imagePath||this.MARKER_CLUSTER_IMAGE_PATH_,this.imageExtension_=s.imageExtension||this.MARKER_CLUSTER_IMAGE_EXTENSION_,this.zoomOnClick_=!0,null!=s.zoomOnClick&&(this.zoomOnClick_=s.zoomOnClick),this.averageCenter_=!1,null!=s.averageCenter&&(this.averageCenter_=s.averageCenter),this.setupStyles_(),this.setMap(t),this.prevZoom_=this.map_.getZoom();var o=this;google.maps.event.addListener(this.map_,"zoom_changed",function(){var t=o.map_.getZoom();o.prevZoom_!=t&&(o.prevZoom_=t,o.resetViewport())}),google.maps.event.addListener(this.map_,"idle",function(){o.redraw()}),e&&e.length&&this.addMarkers(e,!1)}function Cluster(t){this.markerClusterer_=t,this.map_=t.getMap(),this.gridSize_=t.getGridSize(),this.minClusterSize_=t.getMinClusterSize(),this.averageCenter_=t.isAverageCenter(),this.center_=null,this.markers_=[],this.bounds_=null,this.clusterIcon_=new ClusterIcon(this,t.getStyles(),t.getGridSize())}function ClusterIcon(t,e,r){t.getMarkerClusterer().extend(ClusterIcon,google.maps.OverlayView),this.styles_=e,this.padding_=r||0,this.cluster_=t,this.center_=null,this.map_=t.getMap(),this.div_=null,this.sums_=null,this.visible_=!1,this.setMap(this.map_)}MarkerClusterer.prototype.MARKER_CLUSTER_IMAGE_PATH_="../images/m",MarkerClusterer.prototype.MARKER_CLUSTER_IMAGE_EXTENSION_="png",MarkerClusterer.prototype.extend=function(t,e){return function(t){for(var e in t.prototype)this.prototype[e]=t.prototype[e];return this}.apply(t,[e])},MarkerClusterer.prototype.onAdd=function(){this.setReady_(!0)},MarkerClusterer.prototype.draw=function(){},MarkerClusterer.prototype.setupStyles_=function(){if(!this.styles_.length)for(var t,e=0;t=this.sizes[e];e++)this.styles_.push({url:this.imagePath_+(e+1)+"."+this.imageExtension_,height:t,width:t})},MarkerClusterer.prototype.fitMapToMarkers=function(){for(var t,e=this.getMarkers(),r=new google.maps.LatLngBounds,s=0;t=e[s];s++)r.extend(t.getPosition());this.map_.fitBounds(r)},MarkerClusterer.prototype.setStyles=function(t){this.styles_=t},MarkerClusterer.prototype.getStyles=function(){return this.styles_},MarkerClusterer.prototype.isZoomOnClick=function(){return this.zoomOnClick_},MarkerClusterer.prototype.isAverageCenter=function(){return this.averageCenter_},MarkerClusterer.prototype.getMarkers=function(){return this.markers_},MarkerClusterer.prototype.getTotalMarkers=function(){return this.markers_.length},MarkerClusterer.prototype.setMaxZoom=function(t){this.maxZoom_=t},MarkerClusterer.prototype.getMaxZoom=function(){return this.maxZoom_},MarkerClusterer.prototype.calculator_=function(t,e){for(var r=0,s=t.length,o=s;0!==o;)o=parseInt(o/10,10),r++;return{text:s,index:r=Math.min(r,e)}},MarkerClusterer.prototype.setCalculator=function(t){this.calculator_=t},MarkerClusterer.prototype.getCalculator=function(){return this.calculator_},MarkerClusterer.prototype.addMarkers=function(t,e){for(var r,s=0;r=t[s];s++)this.pushMarkerTo_(r);e||this.redraw()},MarkerClusterer.prototype.pushMarkerTo_=function(t){if(t.isAdded=!1,t.draggable){var e=this;google.maps.event.addListener(t,"dragend",function(){t.isAdded=!1,e.repaint()})}this.markers_.push(t)},MarkerClusterer.prototype.addMarker=function(t,e){this.pushMarkerTo_(t),e||this.redraw()},MarkerClusterer.prototype.removeMarker_=function(t){var e=-1;if(this.markers_.indexOf)e=this.markers_.indexOf(t);else for(var r,s=0;r=this.markers_[s];s++)if(r==t){e=s;break}return-1!=e&&(t.setMap(null),this.markers_.splice(e,1),!0)},MarkerClusterer.prototype.removeMarker=function(t,e){var r=this.removeMarker_(t);return!(e||!r)&&(this.resetViewport(),this.redraw(),!0)},MarkerClusterer.prototype.removeMarkers=function(t,e){for(var r,s=!1,o=0;r=t[o];o++){var i=this.removeMarker_(r);s=s||i}if(!e&&s)return this.resetViewport(),this.redraw(),!0},MarkerClusterer.prototype.setReady_=function(t){this.ready_||(this.ready_=t,this.createClusters_())},MarkerClusterer.prototype.getTotalClusters=function(){return this.clusters_.length},MarkerClusterer.prototype.getMap=function(){return this.map_},MarkerClusterer.prototype.setMap=function(t){this.map_=t},MarkerClusterer.prototype.getGridSize=function(){return this.gridSize_},MarkerClusterer.prototype.setGridSize=function(t){this.gridSize_=t},MarkerClusterer.prototype.getMinClusterSize=function(){return this.minClusterSize_},MarkerClusterer.prototype.setMinClusterSize=function(t){this.minClusterSize_=t},MarkerClusterer.prototype.getExtendedBounds=function(t){var e=this.getProjection(),r=new google.maps.LatLng(t.getNorthEast().lat(),t.getNorthEast().lng()),s=new google.maps.LatLng(t.getSouthWest().lat(),t.getSouthWest().lng()),o=e.fromLatLngToDivPixel(r);o.x+=this.gridSize_,o.y-=this.gridSize_;var i=e.fromLatLngToDivPixel(s);i.x-=this.gridSize_,i.y+=this.gridSize_;var n=e.fromDivPixelToLatLng(o),a=e.fromDivPixelToLatLng(i);return t.extend(n),t.extend(a),t},MarkerClusterer.prototype.isMarkerInBounds_=function(t,e){return e.contains(t.getPosition())},MarkerClusterer.prototype.clearMarkers=function(){this.resetViewport(!0),this.markers_=[]},MarkerClusterer.prototype.resetViewport=function(t){for(var e,r=0;e=this.clusters_[r];r++)e.remove();var s;for(r=0;s=this.markers_[r];r++)s.isAdded=!1,t&&s.setMap(null);this.clusters_=[]},MarkerClusterer.prototype.repaint=function(){var t=this.clusters_.slice();this.clusters_.length=0,this.resetViewport(),this.redraw(),window.setTimeout(function(){for(var e,r=0;e=t[r];r++)e.remove()},0)},MarkerClusterer.prototype.redraw=function(){this.createClusters_()},MarkerClusterer.prototype.distanceBetweenPoints_=function(t,e){if(!t||!e)return 0;var r=(e.lat()-t.lat())*Math.PI/180,s=(e.lng()-t.lng())*Math.PI/180,o=Math.sin(r/2)*Math.sin(r/2)+Math.cos(t.lat()*Math.PI/180)*Math.cos(e.lat()*Math.PI/180)*Math.sin(s/2)*Math.sin(s/2);return 6371*(2*Math.atan2(Math.sqrt(o),Math.sqrt(1-o)))},MarkerClusterer.prototype.addToClosestCluster_=function(t){for(var e,r=4e4,s=null,o=(t.getPosition(),0);e=this.clusters_[o];o++){var i=e.getCenter();if(i){var n=this.distanceBetweenPoints_(i,t.getPosition());n<r&&(r=n,s=e)}}s&&s.isMarkerInClusterBounds(t)?s.addMarker(t):((e=new Cluster(this)).addMarker(t),this.clusters_.push(e))},MarkerClusterer.prototype.createClusters_=function(){if(this.ready_)for(var t,e=new google.maps.LatLngBounds(this.map_.getBounds().getSouthWest(),this.map_.getBounds().getNorthEast()),r=this.getExtendedBounds(e),s=0;t=this.markers_[s];s++)!t.isAdded&&this.isMarkerInBounds_(t,r)&&this.addToClosestCluster_(t)},Cluster.prototype.isMarkerAlreadyAdded=function(t){if(this.markers_.indexOf)return-1!=this.markers_.indexOf(t);for(var e,r=0;e=this.markers_[r];r++)if(e==t)return!0;return!1},Cluster.prototype.addMarker=function(t){if(this.isMarkerAlreadyAdded(t))return!1;if(this.center_){if(this.averageCenter_){var e=this.markers_.length+1,r=(this.center_.lat()*(e-1)+t.getPosition().lat())/e,s=(this.center_.lng()*(e-1)+t.getPosition().lng())/e;this.center_=new google.maps.LatLng(r,s),this.calculateBounds_()}}else this.center_=t.getPosition(),this.calculateBounds_();t.isAdded=!0,this.markers_.push(t);var o=this.markers_.length;if(o<this.minClusterSize_&&t.getMap()!=this.map_&&t.setMap(this.map_),o==this.minClusterSize_)for(var i=0;i<o;i++)this.markers_[i].setMap(null);return o>=this.minClusterSize_&&t.setMap(null),this.updateIcon(),!0},Cluster.prototype.getMarkerClusterer=function(){return this.markerClusterer_},Cluster.prototype.getBounds=function(){for(var t,e=new google.maps.LatLngBounds(this.center_,this.center_),r=this.getMarkers(),s=0;t=r[s];s++)e.extend(t.getPosition());return e},Cluster.prototype.remove=function(){this.clusterIcon_.remove(),this.markers_.length=0,delete this.markers_},Cluster.prototype.getSize=function(){return this.markers_.length},Cluster.prototype.getMarkers=function(){return this.markers_},Cluster.prototype.getCenter=function(){return this.center_},Cluster.prototype.calculateBounds_=function(){var t=new google.maps.LatLngBounds(this.center_,this.center_);this.bounds_=this.markerClusterer_.getExtendedBounds(t)},Cluster.prototype.isMarkerInClusterBounds=function(t){return this.bounds_.contains(t.getPosition())},Cluster.prototype.getMap=function(){return this.map_},Cluster.prototype.updateIcon=function(){var t=this.map_.getZoom(),e=this.markerClusterer_.getMaxZoom();if(e&&t>e)for(var r,s=0;r=this.markers_[s];s++)r.setMap(this.map_);else if(this.markers_.length<this.minClusterSize_)this.clusterIcon_.hide();else{var o=this.markerClusterer_.getStyles().length,i=this.markerClusterer_.getCalculator()(this.markers_,o);this.clusterIcon_.setCenter(this.center_),this.clusterIcon_.setSums(i),this.clusterIcon_.show()}},ClusterIcon.prototype.triggerClusterClick=function(t){var e=this.cluster_.getMarkerClusterer();google.maps.event.trigger(e,"clusterclick",this.cluster_,t),e.isZoomOnClick()&&this.map_.fitBounds(this.cluster_.getBounds())},ClusterIcon.prototype.onAdd=function(){if(this.div_=document.createElement("DIV"),this.visible_){var t=this.getPosFromLatLng_(this.center_);this.div_.style.cssText=this.createCss(t),this.div_.innerHTML=this.sums_.text}this.getPanes().overlayMouseTarget.appendChild(this.div_);var e=this,r=!1;google.maps.event.addDomListener(this.div_,"click",function(t){r||e.triggerClusterClick(t)}),google.maps.event.addDomListener(this.div_,"mousedown",function(){r=!1}),google.maps.event.addDomListener(this.div_,"mousemove",function(){r=!0})},ClusterIcon.prototype.getPosFromLatLng_=function(t){var e=this.getProjection().fromLatLngToDivPixel(t);return"object"==typeof this.iconAnchor_&&2===this.iconAnchor_.length?(e.x-=this.iconAnchor_[0],e.y-=this.iconAnchor_[1]):(e.x-=parseInt(this.width_/2,10),e.y-=parseInt(this.height_/2,10)),e},ClusterIcon.prototype.draw=function(){if(this.visible_){var t=this.getPosFromLatLng_(this.center_);this.div_.style.top=t.y+"px",this.div_.style.left=t.x+"px"}},ClusterIcon.prototype.hide=function(){this.div_&&(this.div_.style.display="none"),this.visible_=!1},ClusterIcon.prototype.show=function(){if(this.div_){var t=this.getPosFromLatLng_(this.center_);this.div_.style.cssText=this.createCss(t),this.div_.style.display=""}this.visible_=!0},ClusterIcon.prototype.remove=function(){this.setMap(null)},ClusterIcon.prototype.onRemove=function(){this.div_&&this.div_.parentNode&&(this.hide(),this.div_.parentNode.removeChild(this.div_),this.div_=null)},ClusterIcon.prototype.setSums=function(t){this.sums_=t,this.text_=t.text,this.index_=t.index,this.div_&&(this.div_.innerHTML=t.text),this.useStyle()},ClusterIcon.prototype.useStyle=function(){var t=Math.max(0,this.sums_.index-1);t=Math.min(this.styles_.length-1,t);var e=this.styles_[t];this.url_=e.url,this.height_=e.height,this.width_=e.width,this.textColor_=e.textColor,this.anchor_=e.anchor,this.textSize_=e.textSize,this.backgroundPosition_=e.backgroundPosition,this.iconAnchor_=e.iconAnchor},ClusterIcon.prototype.setCenter=function(t){this.center_=t},ClusterIcon.prototype.createCss=function(t){var e=[];e.push("background-image:url("+this.url_+");");var r=this.backgroundPosition_?this.backgroundPosition_:"0 0";e.push("background-position:"+r+";"),"object"==typeof this.anchor_?("number"==typeof this.anchor_[0]&&this.anchor_[0]>0&&this.anchor_[0]<this.height_?e.push("height:"+(this.height_-this.anchor_[0])+"px; padding-top:"+this.anchor_[0]+"px;"):"number"==typeof this.anchor_[0]&&this.anchor_[0]<0&&-this.anchor_[0]<this.height_?e.push("height:"+this.height_+"px; line-height:"+(this.height_+this.anchor_[0])+"px;"):e.push("height:"+this.height_+"px; line-height:"+this.height_+"px;"),"number"==typeof this.anchor_[1]&&this.anchor_[1]>0&&this.anchor_[1]<this.width_?e.push("width:"+(this.width_-this.anchor_[1])+"px; padding-left:"+this.anchor_[1]+"px;"):e.push("width:"+this.width_+"px; text-align:center;")):e.push("height:"+this.height_+"px; line-height:"+this.height_+"px; width:"+this.width_+"px; text-align:center;");var s=this.textColor_?this.textColor_:"black",o=this.textSize_?this.textSize_:11;return e.push("cursor:pointer; top:"+t.y+"px; left:"+t.x+"px; color:"+s+"; position:absolute; font-size:"+o+"px; font-family:Arial,sans-serif; font-weight:bold"),e.join("")},window.MarkerClusterer=MarkerClusterer,MarkerClusterer.prototype.addMarker=MarkerClusterer.prototype.addMarker,MarkerClusterer.prototype.addMarkers=MarkerClusterer.prototype.addMarkers,MarkerClusterer.prototype.clearMarkers=MarkerClusterer.prototype.clearMarkers,MarkerClusterer.prototype.fitMapToMarkers=MarkerClusterer.prototype.fitMapToMarkers,MarkerClusterer.prototype.getCalculator=MarkerClusterer.prototype.getCalculator,MarkerClusterer.prototype.getGridSize=MarkerClusterer.prototype.getGridSize,MarkerClusterer.prototype.getExtendedBounds=MarkerClusterer.prototype.getExtendedBounds,MarkerClusterer.prototype.getMap=MarkerClusterer.prototype.getMap,MarkerClusterer.prototype.getMarkers=MarkerClusterer.prototype.getMarkers,MarkerClusterer.prototype.getMaxZoom=MarkerClusterer.prototype.getMaxZoom,MarkerClusterer.prototype.getStyles=MarkerClusterer.prototype.getStyles,MarkerClusterer.prototype.getTotalClusters=MarkerClusterer.prototype.getTotalClusters,MarkerClusterer.prototype.getTotalMarkers=MarkerClusterer.prototype.getTotalMarkers,MarkerClusterer.prototype.redraw=MarkerClusterer.prototype.redraw,MarkerClusterer.prototype.removeMarker=MarkerClusterer.prototype.removeMarker,MarkerClusterer.prototype.removeMarkers=MarkerClusterer.prototype.removeMarkers,MarkerClusterer.prototype.resetViewport=MarkerClusterer.prototype.resetViewport,MarkerClusterer.prototype.repaint=MarkerClusterer.prototype.repaint,MarkerClusterer.prototype.setCalculator=MarkerClusterer.prototype.setCalculator,MarkerClusterer.prototype.setGridSize=MarkerClusterer.prototype.setGridSize,MarkerClusterer.prototype.setMaxZoom=MarkerClusterer.prototype.setMaxZoom,MarkerClusterer.prototype.onAdd=MarkerClusterer.prototype.onAdd,MarkerClusterer.prototype.draw=MarkerClusterer.prototype.draw,Cluster.prototype.getCenter=Cluster.prototype.getCenter,Cluster.prototype.getSize=Cluster.prototype.getSize,Cluster.prototype.getMarkers=Cluster.prototype.getMarkers,ClusterIcon.prototype.onAdd=ClusterIcon.prototype.onAdd,ClusterIcon.prototype.draw=ClusterIcon.prototype.draw,ClusterIcon.prototype.onRemove=ClusterIcon.prototype.onRemove;

});

/**
* Display Google Map
*/

function eb_get_google_map( rand , attributes ){ 

	var ID = 'eb_map_' + rand;
	var lat = attributes.latitude;
	var lng = attributes.longitude;
	var zoom = attributes.zoom;
	var description = attributes.description;
	var scrollWheelZoom = attributes.scrollWheelZoom;
	var mapStyle = attributes.mapStyle;
	var streetViewControl = attributes.streetViewControl;
	var mapTypeControl = attributes.mapTypeControl;
	var draggable = attributes.draggable;
	var fullscreenControl = attributes.fullscreenControl;
	var zoomControl = attributes.zoomControl;
	var customMarker = attributes.marker;
	var defaultMarker = attributes.defaultMarker;
	var autoOpenInfoWindow = attributes.autoOpenInfoWindow;
	var centerMarker = attributes.centerMarker;
	var moreMarkers = ( attributes.moreMarkers == '' ? '' : JSON.parse( attributes.moreMarkers ) );

	// MarkerClusterer Settings
	var markerClustererStatus = attributes.markerClustererStatus;
	var maxZoom = attributes.maxZoom;
	var minimumClusterSize = attributes.minimumClusterSize;

	// Create Map
	var mapoptions = {
    	zoom: parseInt( zoom ),
    	center: new google.maps.LatLng( lat,lng ),
    	scrollwheel: scrollWheelZoom,
    	styles: eb_google_map_styles( mapStyle ),
    	streetViewControl: streetViewControl,
        mapTypeControl: mapTypeControl,
        draggable: draggable,
        fullscreenControl: fullscreenControl,
        zoomControl: zoomControl
	};

	setTimeout(function(){ 

		map = new google.maps.Map( document.getElementById( ID ), mapoptions );

		// For centering Map
		var mapID = 'eb_map_' + rand;
		window.mapID = map;

		var locations = [];
		locations[0] = [ description , lat , lng , customMarker , defaultMarker ];

		if( Array.isArray( moreMarkers ) ){

			jQuery.each( moreMarkers, function( key, value ) {
				var index = key + 1;
			  	locations[index] = [ 
			  		value[0].description, 
			  		value[0].lat, 
			  		value[0].lng, 
			  		value[0].marker,
			  		value[0].default_marker 
			  	];
			});

		}

		var mapMarkers = 'eb_marker_' + rand;
		window.mapMarkers = [];
	    var infowindow = new google.maps.InfoWindow();
	    for (i = 0; i < locations.length; i++) { 

			// Create Marker
		    var myLatLng = new google.maps.LatLng( locations[i][1], locations[i][2] );
		    var marker = new google.maps.Marker({
		        position: myLatLng,
		        map: map,
		        animation: google.maps.Animation.DROP,
		        icon: ( locations[i][4] ? '' : locations[i][3] )
		    });  

		    if( locations[i][0] != '' ){

		    	// Info Window
			    infowindow = new google.maps.InfoWindow({
				    content: locations[i][0]
				});  

				google.maps.event.addListener(marker, 'click', (function(marker, i) {
			        return function() {
			          	infowindow.setContent(locations[i][0]);
			          	infowindow.open(map, marker);

			          	// Auto center map on marker click
			          	if( centerMarker ){
			          		map.panTo(marker.getPosition());	
			          	}			          	
			        }
			    })(marker, i));

				if( autoOpenInfoWindow ){
					infowindow.open(map,marker);	
				}
							
		    }

			window.mapMarkers[i] = marker;  

		}	

		// For Marker Cluster
		if( markerClustererStatus == true ){			
			var options = {
	            imagePath: mb_backend_object.ELEGANTBLOCKS_PLUGIN_URL + '/src/images/cluster/m',
	            maxZoom: maxZoom,
	            minimumClusterSize: minimumClusterSize
	        };
			var markerCluster = new MarkerClusterer( map, window.mapMarkers, options );
		}		 
		
	}, 1000 );

}

jQuery(document).on( 
	'click',
	'.more_lat,.more_lng,.place_description_marker,.first_latitude input,.first_longitude input,.first_lat_lng_description textarea', 
	function(){

		if( jQuery(this).hasClass( 'components-text-control__input' ) || jQuery(this).hasClass( 'components-textarea-control__input' ) ){
			var lat = jQuery(this).closest('.components-panel').find('.first_latitude input').val().trim();
			var lng = jQuery(this).closest('.components-panel').find('.first_longitude input').val().trim();
		} else {
			var lat = jQuery(this).closest('.hidden').find('.more_lat').val().trim();
			var lng = jQuery(this).closest('.hidden').find('.more_lng').val().trim();
		}		

		for ( var i = 0; i < window.mapMarkers.length; i++ ) {
			var markerLat = window.mapMarkers[i].position.lat();
			var markerLng = window.mapMarkers[i].position.lng();

			if( Number(Number(lat).toFixed(6)) === Number(Number(markerLat).toFixed(6)) && 
				Number(Number(lng).toFixed(6)) === Number(Number(markerLng).toFixed(6)) && 
				lat != '' &&
				lng != '' ){
				//console.log( 'm in' );
				window.mapID.panTo( window.mapMarkers[i].getPosition() );
				window.mapMarkers[i].setMap( null );
				window.mapMarkers[i].setAnimation(google.maps.Animation.DROP);
				window.mapMarkers[i].setMap( window.mapID );				
			}
		}

});

function eb_google_map_styles( mapStyle ){

	switch( mapStyle ){

		case '2':
			return eb_google_map_style_2();
			break;
		case '3':
			return eb_google_map_style_3();
			break;
		case '4':
			return eb_google_map_style_4();
			break;
		case '5':
			return eb_google_map_style_5();
			break;
		case '6':
			return eb_google_map_style_6();
			break;
		case '7':
			return eb_google_map_style_7();
			break;
		case '8':
			return eb_google_map_style_8();
			break;
		case '9':
			return eb_google_map_style_9();
			break;
		case '10':
			return eb_google_map_style_10();
			break;
		case '11':
			return eb_google_map_style_11();
			break;
		case '12':
			return eb_google_map_style_12();
			break;
		case '13':
			return eb_google_map_style_13();
			break;
		default:
			return '';
			break;

	}

}

function eb_google_map_style_13(){

	return [
	    {
	        "featureType": "water",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "visibility": "on"
	            },
	            {
	                "color": "#aee2e0"
	            }
	        ]
	    },
	    {
	        "featureType": "landscape",
	        "elementType": "geometry.fill",
	        "stylers": [
	            {
	                "color": "#abce83"
	            }
	        ]
	    },
	    {
	        "featureType": "poi",
	        "elementType": "geometry.fill",
	        "stylers": [
	            {
	                "color": "#769E72"
	            }
	        ]
	    },
	    {
	        "featureType": "poi",
	        "elementType": "labels.text.fill",
	        "stylers": [
	            {
	                "color": "#7B8758"
	            }
	        ]
	    },
	    {
	        "featureType": "poi",
	        "elementType": "labels.text.stroke",
	        "stylers": [
	            {
	                "color": "#EBF4A4"
	            }
	        ]
	    },
	    {
	        "featureType": "poi.park",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "visibility": "simplified"
	            },
	            {
	                "color": "#8dab68"
	            }
	        ]
	    },
	    {
	        "featureType": "road",
	        "elementType": "geometry.fill",
	        "stylers": [
	            {
	                "visibility": "simplified"
	            }
	        ]
	    },
	    {
	        "featureType": "road",
	        "elementType": "labels.text.fill",
	        "stylers": [
	            {
	                "color": "#5B5B3F"
	            }
	        ]
	    },
	    {
	        "featureType": "road",
	        "elementType": "labels.text.stroke",
	        "stylers": [
	            {
	                "color": "#ABCE83"
	            }
	        ]
	    },
	    {
	        "featureType": "road",
	        "elementType": "labels.icon",
	        "stylers": [
	            {
	                "visibility": "off"
	            }
	        ]
	    },
	    {
	        "featureType": "road.local",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#A4C67D"
	            }
	        ]
	    },
	    {
	        "featureType": "road.arterial",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#9BBF72"
	            }
	        ]
	    },
	    {
	        "featureType": "road.highway",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#EBF4A4"
	            }
	        ]
	    },
	    {
	        "featureType": "transit",
	        "stylers": [
	            {
	                "visibility": "off"
	            }
	        ]
	    },
	    {
	        "featureType": "administrative",
	        "elementType": "geometry.stroke",
	        "stylers": [
	            {
	                "visibility": "on"
	            },
	            {
	                "color": "#87ae79"
	            }
	        ]
	    },
	    {
	        "featureType": "administrative",
	        "elementType": "geometry.fill",
	        "stylers": [
	            {
	                "color": "#7f2200"
	            },
	            {
	                "visibility": "off"
	            }
	        ]
	    },
	    {
	        "featureType": "administrative",
	        "elementType": "labels.text.stroke",
	        "stylers": [
	            {
	                "color": "#ffffff"
	            },
	            {
	                "visibility": "on"
	            },
	            {
	                "weight": 4.1
	            }
	        ]
	    },
	    {
	        "featureType": "administrative",
	        "elementType": "labels.text.fill",
	        "stylers": [
	            {
	                "color": "#495421"
	            }
	        ]
	    },
	    {
	        "featureType": "administrative.neighborhood",
	        "elementType": "labels",
	        "stylers": [
	            {
	                "visibility": "off"
	            }
	        ]
	    }
	];

}

function eb_google_map_style_12(){
	return [
	    {
	        "featureType": "all",
	        "elementType": "all",
	        "stylers": [
	            {
	                "saturation": -100
	            },
	            {
	                "gamma": 0.5
	            }
	        ]
	    }
	]
}

function eb_google_map_style_11(){

	return [
	    {
	        "featureType": "water",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#193341"
	            }
	        ]
	    },
	    {
	        "featureType": "landscape",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#2c5a71"
	            }
	        ]
	    },
	    {
	        "featureType": "road",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#29768a"
	            },
	            {
	                "lightness": -37
	            }
	        ]
	    },
	    {
	        "featureType": "poi",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#406d80"
	            }
	        ]
	    },
	    {
	        "featureType": "transit",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#406d80"
	            }
	        ]
	    },
	    {
	        "elementType": "labels.text.stroke",
	        "stylers": [
	            {
	                "visibility": "on"
	            },
	            {
	                "color": "#3e606f"
	            },
	            {
	                "weight": 2
	            },
	            {
	                "gamma": 0.84
	            }
	        ]
	    },
	    {
	        "elementType": "labels.text.fill",
	        "stylers": [
	            {
	                "color": "#ffffff"
	            }
	        ]
	    },
	    {
	        "featureType": "administrative",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "weight": 0.6
	            },
	            {
	                "color": "#1a3541"
	            }
	        ]
	    },
	    {
	        "elementType": "labels.icon",
	        "stylers": [
	            {
	                "visibility": "off"
	            }
	        ]
	    },
	    {
	        "featureType": "poi.park",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#2c5a71"
	            }
	        ]
	    }
	];

}

function eb_google_map_style_10(){

	return [
	    {
	        "featureType": "landscape",
	        "elementType": "labels",
	        "stylers": [
	            {
	                "visibility": "off"
	            }
	        ]
	    },
	    {
	        "featureType": "transit",
	        "elementType": "labels",
	        "stylers": [
	            {
	                "visibility": "off"
	            }
	        ]
	    },
	    {
	        "featureType": "poi",
	        "elementType": "labels",
	        "stylers": [
	            {
	                "visibility": "off"
	            }
	        ]
	    },
	    {
	        "featureType": "water",
	        "elementType": "labels",
	        "stylers": [
	            {
	                "visibility": "off"
	            }
	        ]
	    },
	    {
	        "featureType": "road",
	        "elementType": "labels.icon",
	        "stylers": [
	            {
	                "visibility": "off"
	            }
	        ]
	    },
	    {
	        "stylers": [
	            {
	                "hue": "#00aaff"
	            },
	            {
	                "saturation": -100
	            },
	            {
	                "gamma": 2.15
	            },
	            {
	                "lightness": 12
	            }
	        ]
	    },
	    {
	        "featureType": "road",
	        "elementType": "labels.text.fill",
	        "stylers": [
	            {
	                "visibility": "on"
	            },
	            {
	                "lightness": 24
	            }
	        ]
	    },
	    {
	        "featureType": "road",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "lightness": 57
	            }
	        ]
	    }
	];

}

function eb_google_map_style_9(){

	return [
	    {
	        "featureType": "all",
	        "elementType": "labels.text.fill",
	        "stylers": [
	            {
	                "color": "#ffffff"
	            }
	        ]
	    },
	    {
	        "featureType": "all",
	        "elementType": "labels.text.stroke",
	        "stylers": [
	            {
	                "color": "#000000"
	            },
	            {
	                "lightness": 13
	            }
	        ]
	    },
	    {
	        "featureType": "administrative",
	        "elementType": "geometry.fill",
	        "stylers": [
	            {
	                "color": "#000000"
	            }
	        ]
	    },
	    {
	        "featureType": "administrative",
	        "elementType": "geometry.stroke",
	        "stylers": [
	            {
	                "color": "#144b53"
	            },
	            {
	                "lightness": 14
	            },
	            {
	                "weight": 1.4
	            }
	        ]
	    },
	    {
	        "featureType": "landscape",
	        "elementType": "all",
	        "stylers": [
	            {
	                "color": "#08304b"
	            }
	        ]
	    },
	    {
	        "featureType": "poi",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#0c4152"
	            },
	            {
	                "lightness": 5
	            }
	        ]
	    },
	    {
	        "featureType": "road.highway",
	        "elementType": "geometry.fill",
	        "stylers": [
	            {
	                "color": "#000000"
	            }
	        ]
	    },
	    {
	        "featureType": "road.highway",
	        "elementType": "geometry.stroke",
	        "stylers": [
	            {
	                "color": "#0b434f"
	            },
	            {
	                "lightness": 25
	            }
	        ]
	    },
	    {
	        "featureType": "road.arterial",
	        "elementType": "geometry.fill",
	        "stylers": [
	            {
	                "color": "#000000"
	            }
	        ]
	    },
	    {
	        "featureType": "road.arterial",
	        "elementType": "geometry.stroke",
	        "stylers": [
	            {
	                "color": "#0b3d51"
	            },
	            {
	                "lightness": 16
	            }
	        ]
	    },
	    {
	        "featureType": "road.local",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#000000"
	            }
	        ]
	    },
	    {
	        "featureType": "transit",
	        "elementType": "all",
	        "stylers": [
	            {
	                "color": "#146474"
	            }
	        ]
	    },
	    {
	        "featureType": "water",
	        "elementType": "all",
	        "stylers": [
	            {
	                "color": "#021019"
	            }
	        ]
	    }
	];

}

function eb_google_map_style_8(){

	return [
	    {
	        "featureType": "administrative",
	        "elementType": "all",
	        "stylers": [
	            {
	                "visibility": "on"
	            },
	            {
	                "lightness": 33
	            }
	        ]
	    },
	    {
	        "featureType": "landscape",
	        "elementType": "all",
	        "stylers": [
	            {
	                "color": "#f2e5d4"
	            }
	        ]
	    },
	    {
	        "featureType": "poi.park",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#c5dac6"
	            }
	        ]
	    },
	    {
	        "featureType": "poi.park",
	        "elementType": "labels",
	        "stylers": [
	            {
	                "visibility": "on"
	            },
	            {
	                "lightness": 20
	            }
	        ]
	    },
	    {
	        "featureType": "road",
	        "elementType": "all",
	        "stylers": [
	            {
	                "lightness": 20
	            }
	        ]
	    },
	    {
	        "featureType": "road.highway",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#c5c6c6"
	            }
	        ]
	    },
	    {
	        "featureType": "road.arterial",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#e4d7c6"
	            }
	        ]
	    },
	    {
	        "featureType": "road.local",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#fbfaf7"
	            }
	        ]
	    },
	    {
	        "featureType": "water",
	        "elementType": "all",
	        "stylers": [
	            {
	                "visibility": "on"
	            },
	            {
	                "color": "#acbcc9"
	            }
	        ]
	    }
	];

}

function eb_google_map_style_7(){

	return [
	    {
	        "featureType": "administrative",
	        "elementType": "all",
	        "stylers": [
	            {
	                "visibility": "off"
	            }
	        ]
	    },
	    {
	        "featureType": "landscape",
	        "elementType": "all",
	        "stylers": [
	            {
	                "visibility": "simplified"
	            },
	            {
	                "hue": "#0066ff"
	            },
	            {
	                "saturation": 74
	            },
	            {
	                "lightness": 100
	            }
	        ]
	    },
	    {
	        "featureType": "poi",
	        "elementType": "all",
	        "stylers": [
	            {
	                "visibility": "simplified"
	            }
	        ]
	    },
	    {
	        "featureType": "road",
	        "elementType": "all",
	        "stylers": [
	            {
	                "visibility": "simplified"
	            }
	        ]
	    },
	    {
	        "featureType": "road.highway",
	        "elementType": "all",
	        "stylers": [
	            {
	                "visibility": "off"
	            },
	            {
	                "weight": 0.6
	            },
	            {
	                "saturation": -85
	            },
	            {
	                "lightness": 61
	            }
	        ]
	    },
	    {
	        "featureType": "road.highway",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "visibility": "on"
	            }
	        ]
	    },
	    {
	        "featureType": "road.arterial",
	        "elementType": "all",
	        "stylers": [
	            {
	                "visibility": "off"
	            }
	        ]
	    },
	    {
	        "featureType": "road.local",
	        "elementType": "all",
	        "stylers": [
	            {
	                "visibility": "on"
	            }
	        ]
	    },
	    {
	        "featureType": "transit",
	        "elementType": "all",
	        "stylers": [
	            {
	                "visibility": "simplified"
	            }
	        ]
	    },
	    {
	        "featureType": "water",
	        "elementType": "all",
	        "stylers": [
	            {
	                "visibility": "simplified"
	            },
	            {
	                "color": "#5f94ff"
	            },
	            {
	                "lightness": 26
	            },
	            {
	                "gamma": 5.86
	            }
	        ]
	    }
	];

}

function eb_google_map_style_6(){

	return [
	    {
	        "featureType": "landscape",
	        "stylers": [
	            {
	                "hue": "#FFBB00"
	            },
	            {
	                "saturation": 43.400000000000006
	            },
	            {
	                "lightness": 37.599999999999994
	            },
	            {
	                "gamma": 1
	            }
	        ]
	    },
	    {
	        "featureType": "road.highway",
	        "stylers": [
	            {
	                "hue": "#FFC200"
	            },
	            {
	                "saturation": -61.8
	            },
	            {
	                "lightness": 45.599999999999994
	            },
	            {
	                "gamma": 1
	            }
	        ]
	    },
	    {
	        "featureType": "road.arterial",
	        "stylers": [
	            {
	                "hue": "#FF0300"
	            },
	            {
	                "saturation": -100
	            },
	            {
	                "lightness": 51.19999999999999
	            },
	            {
	                "gamma": 1
	            }
	        ]
	    },
	    {
	        "featureType": "road.local",
	        "stylers": [
	            {
	                "hue": "#FF0300"
	            },
	            {
	                "saturation": -100
	            },
	            {
	                "lightness": 52
	            },
	            {
	                "gamma": 1
	            }
	        ]
	    },
	    {
	        "featureType": "water",
	        "stylers": [
	            {
	                "hue": "#0078FF"
	            },
	            {
	                "saturation": -13.200000000000003
	            },
	            {
	                "lightness": 2.4000000000000057
	            },
	            {
	                "gamma": 1
	            }
	        ]
	    },
	    {
	        "featureType": "poi",
	        "stylers": [
	            {
	                "hue": "#00FF6A"
	            },
	            {
	                "saturation": -1.0989010989011234
	            },
	            {
	                "lightness": 11.200000000000017
	            },
	            {
	                "gamma": 1
	            }
	        ]
	    }
	];

}

function eb_google_map_style_5(){

	return [
	    {
	        "featureType": "all",
	        "elementType": "all",
	        "stylers": [
	            {
	                "color": "#ff7000"
	            },
	            {
	                "lightness": "69"
	            },
	            {
	                "saturation": "100"
	            },
	            {
	                "weight": "1.17"
	            },
	            {
	                "gamma": "2.04"
	            }
	        ]
	    },
	    {
	        "featureType": "all",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#cb8536"
	            }
	        ]
	    },
	    {
	        "featureType": "all",
	        "elementType": "labels",
	        "stylers": [
	            {
	                "color": "#ffb471"
	            },
	            {
	                "lightness": "66"
	            },
	            {
	                "saturation": "100"
	            }
	        ]
	    },
	    {
	        "featureType": "all",
	        "elementType": "labels.text.fill",
	        "stylers": [
	            {
	                "gamma": 0.01
	            },
	            {
	                "lightness": 20
	            }
	        ]
	    },
	    {
	        "featureType": "all",
	        "elementType": "labels.text.stroke",
	        "stylers": [
	            {
	                "saturation": -31
	            },
	            {
	                "lightness": -33
	            },
	            {
	                "weight": 2
	            },
	            {
	                "gamma": 0.8
	            }
	        ]
	    },
	    {
	        "featureType": "all",
	        "elementType": "labels.icon",
	        "stylers": [
	            {
	                "visibility": "off"
	            }
	        ]
	    },
	    {
	        "featureType": "landscape",
	        "elementType": "all",
	        "stylers": [
	            {
	                "lightness": "-8"
	            },
	            {
	                "gamma": "0.98"
	            },
	            {
	                "weight": "2.45"
	            },
	            {
	                "saturation": "26"
	            }
	        ]
	    },
	    {
	        "featureType": "landscape",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "lightness": 30
	            },
	            {
	                "saturation": 30
	            }
	        ]
	    },
	    {
	        "featureType": "poi",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "saturation": 20
	            }
	        ]
	    },
	    {
	        "featureType": "poi.park",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "lightness": 20
	            },
	            {
	                "saturation": -20
	            }
	        ]
	    },
	    {
	        "featureType": "road",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "lightness": 10
	            },
	            {
	                "saturation": -30
	            }
	        ]
	    },
	    {
	        "featureType": "road",
	        "elementType": "geometry.stroke",
	        "stylers": [
	            {
	                "saturation": 25
	            },
	            {
	                "lightness": 25
	            }
	        ]
	    },
	    {
	        "featureType": "water",
	        "elementType": "all",
	        "stylers": [
	            {
	                "lightness": -20
	            },
	            {
	                "color": "#ecc080"
	            }
	        ]
	    }
	];

}

function eb_google_map_style_4(){

	return [
	    {
	        "featureType": "all",
	        "elementType": "labels.text.fill",
	        "stylers": [
	            {
	                "saturation": 36
	            },
	            {
	                "color": "#000000"
	            },
	            {
	                "lightness": 40
	            }
	        ]
	    },
	    {
	        "featureType": "all",
	        "elementType": "labels.text.stroke",
	        "stylers": [
	            {
	                "visibility": "on"
	            },
	            {
	                "color": "#000000"
	            },
	            {
	                "lightness": 16
	            }
	        ]
	    },
	    {
	        "featureType": "all",
	        "elementType": "labels.icon",
	        "stylers": [
	            {
	                "visibility": "off"
	            }
	        ]
	    },
	    {
	        "featureType": "administrative",
	        "elementType": "geometry.fill",
	        "stylers": [
	            {
	                "color": "#000000"
	            },
	            {
	                "lightness": 20
	            }
	        ]
	    },
	    {
	        "featureType": "administrative",
	        "elementType": "geometry.stroke",
	        "stylers": [
	            {
	                "color": "#000000"
	            },
	            {
	                "lightness": 17
	            },
	            {
	                "weight": 1.2
	            }
	        ]
	    },
	    {
	        "featureType": "landscape",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#000000"
	            },
	            {
	                "lightness": 20
	            }
	        ]
	    },
	    {
	        "featureType": "poi",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#000000"
	            },
	            {
	                "lightness": 21
	            }
	        ]
	    },
	    {
	        "featureType": "road.highway",
	        "elementType": "geometry.fill",
	        "stylers": [
	            {
	                "color": "#000000"
	            },
	            {
	                "lightness": 17
	            }
	        ]
	    },
	    {
	        "featureType": "road.highway",
	        "elementType": "geometry.stroke",
	        "stylers": [
	            {
	                "color": "#000000"
	            },
	            {
	                "lightness": 29
	            },
	            {
	                "weight": 0.2
	            }
	        ]
	    },
	    {
	        "featureType": "road.arterial",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#000000"
	            },
	            {
	                "lightness": 18
	            }
	        ]
	    },
	    {
	        "featureType": "road.local",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#000000"
	            },
	            {
	                "lightness": 16
	            }
	        ]
	    },
	    {
	        "featureType": "transit",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#000000"
	            },
	            {
	                "lightness": 19
	            }
	        ]
	    },
	    {
	        "featureType": "water",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#000000"
	            },
	            {
	                "lightness": 17
	            }
	        ]
	    }
	];

}

function eb_google_map_style_3(){

	return [
	    {
	        "featureType": "administrative",
	        "elementType": "all",
	        "stylers": [
	            {
	                "saturation": "-100"
	            }
	        ]
	    },
	    {
	        "featureType": "administrative.province",
	        "elementType": "all",
	        "stylers": [
	            {
	                "visibility": "off"
	            }
	        ]
	    },
	    {
	        "featureType": "landscape",
	        "elementType": "all",
	        "stylers": [
	            {
	                "saturation": -100
	            },
	            {
	                "lightness": 65
	            },
	            {
	                "visibility": "on"
	            }
	        ]
	    },
	    {
	        "featureType": "poi",
	        "elementType": "all",
	        "stylers": [
	            {
	                "saturation": -100
	            },
	            {
	                "lightness": "50"
	            },
	            {
	                "visibility": "simplified"
	            }
	        ]
	    },
	    {
	        "featureType": "road",
	        "elementType": "all",
	        "stylers": [
	            {
	                "saturation": "-100"
	            }
	        ]
	    },
	    {
	        "featureType": "road.highway",
	        "elementType": "all",
	        "stylers": [
	            {
	                "visibility": "simplified"
	            }
	        ]
	    },
	    {
	        "featureType": "road.arterial",
	        "elementType": "all",
	        "stylers": [
	            {
	                "lightness": "30"
	            }
	        ]
	    },
	    {
	        "featureType": "road.local",
	        "elementType": "all",
	        "stylers": [
	            {
	                "lightness": "40"
	            }
	        ]
	    },
	    {
	        "featureType": "transit",
	        "elementType": "all",
	        "stylers": [
	            {
	                "saturation": -100
	            },
	            {
	                "visibility": "simplified"
	            }
	        ]
	    },
	    {
	        "featureType": "water",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "hue": "#ffff00"
	            },
	            {
	                "lightness": -25
	            },
	            {
	                "saturation": -97
	            }
	        ]
	    },
	    {
	        "featureType": "water",
	        "elementType": "labels",
	        "stylers": [
	            {
	                "lightness": -25
	            },
	            {
	                "saturation": -100
	            }
	        ]
	    }
	];

}

function eb_google_map_style_2(){

	return [
	    {
	        "featureType": "water",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#e9e9e9"
	            },
	            {
	                "lightness": 17
	            }
	        ]
	    },
	    {
	        "featureType": "landscape",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#f5f5f5"
	            },
	            {
	                "lightness": 20
	            }
	        ]
	    },
	    {
	        "featureType": "road.highway",
	        "elementType": "geometry.fill",
	        "stylers": [
	            {
	                "color": "#ffffff"
	            },
	            {
	                "lightness": 17
	            }
	        ]
	    },
	    {
	        "featureType": "road.highway",
	        "elementType": "geometry.stroke",
	        "stylers": [
	            {
	                "color": "#ffffff"
	            },
	            {
	                "lightness": 29
	            },
	            {
	                "weight": 0.2
	            }
	        ]
	    },
	    {
	        "featureType": "road.arterial",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#ffffff"
	            },
	            {
	                "lightness": 18
	            }
	        ]
	    },
	    {
	        "featureType": "road.local",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#ffffff"
	            },
	            {
	                "lightness": 16
	            }
	        ]
	    },
	    {
	        "featureType": "poi",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#f5f5f5"
	            },
	            {
	                "lightness": 21
	            }
	        ]
	    },
	    {
	        "featureType": "poi.park",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#dedede"
	            },
	            {
	                "lightness": 21
	            }
	        ]
	    },
	    {
	        "elementType": "labels.text.stroke",
	        "stylers": [
	            {
	                "visibility": "on"
	            },
	            {
	                "color": "#ffffff"
	            },
	            {
	                "lightness": 16
	            }
	        ]
	    },
	    {
	        "elementType": "labels.text.fill",
	        "stylers": [
	            {
	                "saturation": 36
	            },
	            {
	                "color": "#333333"
	            },
	            {
	                "lightness": 40
	            }
	        ]
	    },
	    {
	        "elementType": "labels.icon",
	        "stylers": [
	            {
	                "visibility": "off"
	            }
	        ]
	    },
	    {
	        "featureType": "transit",
	        "elementType": "geometry",
	        "stylers": [
	            {
	                "color": "#f2f2f2"
	            },
	            {
	                "lightness": 19
	            }
	        ]
	    },
	    {
	        "featureType": "administrative",
	        "elementType": "geometry.fill",
	        "stylers": [
	            {
	                "color": "#fefefe"
	            },
	            {
	                "lightness": 20
	            }
	        ]
	    },
	    {
	        "featureType": "administrative",
	        "elementType": "geometry.stroke",
	        "stylers": [
	            {
	                "color": "#fefefe"
	            },
	            {
	                "lightness": 17
	            },
	            {
	                "weight": 1.2
	            }
	        ]
	    }
	];

}