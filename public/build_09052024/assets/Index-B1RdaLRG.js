import{i as w,Z as b,p as i,o as s,c as x,w as r,d as o,f as c,a as t,b as d,F as _,t as l,y as u,g as m}from"./app-BjkeQK_V.js";import{_ as L}from"./BlogLayout-DCcNUokv.js";import{P as N}from"./PaginationPrevNext-SHUBRfEr.js";import{_ as B,a as H}from"./ResponsiveNavLink-BQJW1pNG.js";import{_ as j}from"./_plugin-vue_export-helper-DlAUqK2U.js";const C={methods:{formatDate(a){const h=new Date(a);let n={year:"numeric",month:"long",day:"numeric",hour:"numeric",minute:"numeric",hour12:!1};return new Intl.DateTimeFormat(void 0,n).format(h)}},components:{Link:w,BlogLayout:L,Pagination:N,NavLink:B,ResponsiveNavLink:H,Head:b},props:{posts:Object,categories:Object}},M={class:"hidden space-x-8 sm:-my-px sm:ms-4 sm:flex h-full"},D=["src"],T=["src"],V={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},P={class:"container mt-5"},F={key:0,class:"grid grid-cols-1 sm:grid-cols-2 gap-3 h"},I={class:"p-5 w-full"},R=["href"],Z=["src"],A={class:"mt-3"},O=["href"],S={class:"mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white hover:text-indigo-800 transition"},z={class:""},E=["href"],q={key:0,class:"mb-2"},G=t("small",{class:"uppercase my-3 font-semibold text-gray-400 block"},"#Promo",-1),J=[G],K=["innerHTML"],Q={class:"w-100"},U={class:"mb-2 inline-flex text-gray-500"},W=t("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-4 h-4 ml-1 mt-1"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"})],-1),X={class:"inline-flex text-gray-500"},Y=["src"],$={class:"mt-1"},tt={key:1,class:"grid grid-cols-1 sm:grid-cols-3 gap-3 flex justify-center"},et={class:"p-5 w-full"},st=["href"],ot=["src"],at={class:"mt-3"},nt=["href"],lt={class:"mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white hover:text-indigo-800 transition"},it={class:"mb-2"},rt=["href"],ct={key:0,class:"mb-2"},dt=t("small",{class:"uppercase my-3 font-semibold text-gray-400 block"},"#Promo",-1),_t=[dt],mt=["innerHTML"],ht={class:"w-100"},gt={class:"mb-2 inline-flex text-gray-500"},ut=t("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-4 h-4 ml-1 mt-1"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"})],-1),ft={class:"inline-flex text-gray-500"},vt=["src"],yt={class:"mt-1"},kt={key:2,class:"w-full p-5"},pt=t("small",null,"Mas noticias",-1),wt={key:3},bt=t("div",{class:"bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4",role:"alert"},[t("p",null,"No hay artículos")],-1),xt=[bt];function Lt(a,h,n,Nt,Bt,g){const f=i("Head"),v=i("NavLink"),y=i("ResponsiveNavLink"),k=i("pagination"),p=i("BlogLayout");return s(),x(p,null,{catnavs:r(()=>[(s(!0),o(_,null,c(n.categories,e=>(s(),o("div",{key:e.id},[t("div",M,[d(v,{href:a.route("blog.category",e.title),active:a.route().current("blog.category",e.title)},{default:r(()=>[t("img",{class:"h-4 w-4",src:"/image/category/"+e.image},null,8,D)]),_:2},1032,["href","active"])])]))),128))]),catnavs_responsive:r(()=>[(s(!0),o(_,null,c(n.categories,e=>(s(),o("div",{key:e.id},[d(y,{href:a.route("blog.category",e.title),active:a.route().current("blog.category",e.title)},{default:r(()=>[t("img",{class:"h-4 w-4",src:"/image/category/"+e.image},null,8,T)]),_:2},1032,["href","active"])]))),128))]),default:r(()=>[d(f,{title:"Inicio"}),t("div",V,[t("div",P,[n.posts.data.length>0?(s(),o("div",F,[(s(!0),o(_,null,c(n.posts.data.slice(0,2),e=>(s(),o("div",{key:e.id},[t("div",I,[t("a",{href:a.route("blog.post.show",e.slug)},[t("img",{class:"hover:scale-105 transition-all object-cover h-96 w-full rounded-lg",src:"/image/post/"+e.image,alt:""},null,8,Z)],8,R),t("div",A,[t("a",{href:a.route("blog.post.show",e.slug)},[t("h5",S,l(e.title),1)],8,O),t("p",z,[t("a",{href:a.route("blog.category",e.category.title),class:"uppercase font-semibold",style:u("color: "+e.category.color)},l(e.category.title),13,E)]),e.type=="#ad"?(s(),o("p",q,J)):m("",!0),t("div",null,[t("p",{class:"mb-2 font-normal text-gray-700 dark:text-gray-400",innerHTML:e.description},null,8,K)]),t("div",Q,[t("p",U,[t("small",null,l(e.comments_count),1),W])]),t("div",X,[t("img",{class:"h-8 w-8 rounded-full mr-3",src:"/image/author/"+e.author.image},null,8,Y),t("small",$,l(e.author.name)+" - "+l(g.formatDate(e.created_at)),1)])])])]))),128))])):m("",!0),n.posts.data.length>0?(s(),o("div",tt,[(s(!0),o(_,null,c(n.posts.data.slice(2),e=>(s(),o("div",{key:e.id},[t("div",et,[t("a",{href:a.route("blog.post.show",e.slug)},[t("img",{class:"object-cover hover:scale-105 transition-all h-72 w-full rounded-lg",src:"/image/post/"+e.image,alt:""},null,8,ot)],8,st),t("div",at,[t("a",{href:a.route("blog.post.show",e.slug)},[t("h5",lt,l(e.title),1)],8,nt),t("p",it,[t("a",{href:a.route("blog.category",e.category.title),class:"uppercase font-semibold",style:u("color: "+e.category.color)},l(e.category.title),13,rt)]),e.type=="#ad"?(s(),o("p",ct,_t)):m("",!0),t("div",null,[t("p",{class:"mb-2 font-normal text-gray-700 dark:text-gray-400",innerHTML:e.description},null,8,mt)]),t("div",ht,[t("p",gt,[t("small",null,l(e.comments_count),1),ut])]),t("div",ft,[t("img",{class:"h-8 w-8 rounded-full mr-3",src:"/image/author/"+e.author.image},null,8,vt),t("small",yt,l(e.author.name)+" - "+l(g.formatDate(e.created_at)),1)])])])]))),128))])):m("",!0),n.posts.data.length>0?(s(),o("div",kt,[pt,d(k,{links:n.posts},null,8,["links"])])):(s(),o("div",wt,xt))])])]),_:1})}const Tt=j(C,[["render",Lt]]);export{Tt as default};
