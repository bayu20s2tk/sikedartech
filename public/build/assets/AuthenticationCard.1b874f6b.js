import{d as r,i as d,l as c,o as m,e as h,a as e,r as a,t as p,m as _,f,n as g,K as u}from"./app.894b1448.js";const v={class:"min-h-screen flex bg-white bg-glass bg-fixed"},w={class:"min-h-screen mb-80 lg:mb-0 flex-1 flex flex-col justify-center px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24"},b={class:"mx-auto w-full max-w-sm lg:w-96 py-10"},k=e("h2",{class:"mt-6 text-3xl font-extrabold text-gray-900"},"Selamat Datang",-1),y={class:"mt-2 text-sm text-gray-600"},S={class:"mt-8"},j={class:"mb-5"},C={key:0,class:"bg-red-700 rounded-3xl"},B={class:"max-w-screen-xl mx-auto py-3 px-3"},$={class:"flex items-center justify-between flex-wrap"},M={class:"w-0 flex-1 flex items-center min-w-0"},N=e("span",{class:"flex bg-red-600 p-2 rounded-3xl"},[e("svg",{class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"})])],-1),L={class:"ml-3 font-medium text-sm text-white"},z={class:"shrink-0 sm:ml-3 p-2"},D=e("svg",{class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"})],-1),I=[D],J=e("div",{class:"hidden lg:block relative w-0 flex-1"},[e("img",{class:"absolute inset-0 h-full w-full object-cover",src:"/img/auth.png",alt:""})],-1),A={__name:"AuthenticationCard",props:{darkMode:Boolean},setup(O){var i;const l=r(!0);d(()=>{var s;return((s=u().props.jetstream.flash)==null?void 0:s.bannerStyle)||"success"});const n=d(()=>{var s;return((s=u().props.jetstream.flash)==null?void 0:s.banner)||""});c(n,async()=>{l.value=!0});const t=r((i=JSON.parse(localStorage.getItem("darkmode")))!=null?i:!1);return c(t,s=>{console.log(`darkmode is ${s}`),localStorage.setItem("darkmode",JSON.stringify(s))}),(s,o)=>(m(),h("div",{class:g(["",t.value?"nightwind dark":"nightwind"])},[e("div",v,[e("div",w,[e("div",b,[e("div",null,[e("button",{onClick:o[0]||(o[0]=x=>t.value=!t.value)},[a(s.$slots,"logo")]),k,e("p",y,[a(s.$slots,"title")])]),e("div",S,[e("div",j,[l.value&&n.value?(m(),h("div",C,[e("div",B,[e("div",$,[e("div",M,[N,e("p",L,p(n.value),1)]),e("div",z,[e("button",{type:"button",class:"-mr-1 flex p-2 hover:bg-red-600 focus:bg-red-600 rounded-3xl focus:outline-none sm:-mr-2 transition","aria-label":"Dismiss",onClick:o[1]||(o[1]=_(x=>l.value=!1,["prevent"]))},I)])])])])):f("",!0)]),a(s.$slots,"default")])])]),J])],2))}};export{A as _};
