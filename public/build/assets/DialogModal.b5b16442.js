import{B as f,s as h,v,i as p,o as x,c as w,b as d,w as o,G as r,a as s,C as m,H as u,n as b,r as l,f as _,y as g}from"./app.5add3a04.js";const B={class:"fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50","scroll-region":""},$=s("div",{class:"absolute inset-0 bg-gray-500 opacity-75"},null,-1),k=[$],C={__name:"Modal",props:{show:{type:Boolean,default:!1},maxWidth:{type:String,default:"2xl"},closeable:{type:Boolean,default:!0}},emits:["close"],setup(e,{emit:n}){const a=e;f(()=>a.show,()=>{a.show?document.body.style.overflow="hidden":document.body.style.overflow=null});const t=()=>{a.closeable&&n("close")},c=i=>{i.key==="Escape"&&a.show&&t()};h(()=>document.addEventListener("keydown",c)),v(()=>{document.removeEventListener("keydown",c),document.body.style.overflow=null});const y=p(()=>({sm:"sm:max-w-sm",md:"sm:max-w-md",lg:"sm:max-w-lg",xl:"sm:max-w-xl","2xl":"sm:max-w-2xl","3xl":"sm:max-w-3xl","4xl":"sm:max-w-4xl","5xl":"sm:max-w-5xl","6xl":"sm:max-w-6xl","7xl":"sm:max-w-7xl"})[a.maxWidth]);return(i,N)=>(x(),w(g,{to:"body"},[d(m,{"leave-active-class":"duration-200"},{default:o(()=>[r(s("div",B,[d(m,{"enter-active-class":"ease-out duration-300","enter-from-class":"opacity-0","enter-to-class":"opacity-100","leave-active-class":"ease-in duration-200","leave-from-class":"opacity-100","leave-to-class":"opacity-0"},{default:o(()=>[r(s("div",{class:"fixed inset-0 transform transition-all",onClick:t},k,512),[[u,e.show]])]),_:1}),d(m,{"enter-active-class":"ease-out duration-300","enter-from-class":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95","enter-to-class":"opacity-100 translate-y-0 sm:scale-100","leave-active-class":"ease-in duration-200","leave-from-class":"opacity-100 translate-y-0 sm:scale-100","leave-to-class":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"},{default:o(()=>[r(s("div",{class:b(["mb-6 bg-white rounded-3xl overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto",y.value])},[e.show?l(i.$slots,"default",{key:0}):_("",!0)],2),[[u,e.show]])]),_:3})],512),[[u,e.show]])]),_:3})]))}},W={class:"px-6 py-4"},E={class:"text-lg"},S={class:"mt-4"},M={class:"flex flex-row justify-end px-6 py-4 bg-gray-100 text-right"},z={__name:"DialogModal",props:{show:{type:Boolean,default:!1},maxWidth:{type:String,default:"2xl"},closeable:{type:Boolean,default:!0}},emits:["close"],setup(e,{emit:n}){const a=()=>{n("close")};return(t,c)=>(x(),w(C,{show:e.show,"max-width":e.maxWidth,closeable:e.closeable,onClose:a},{default:o(()=>[s("div",W,[s("div",E,[l(t.$slots,"title")]),s("div",S,[l(t.$slots,"content")])]),s("div",M,[l(t.$slots,"footer")])]),_:3},8,["show","max-width","closeable"]))}};export{C as _,z as a};