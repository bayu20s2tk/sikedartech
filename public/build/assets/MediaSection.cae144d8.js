import{T as g,d as u,e as i,F as v,h as b,a as e,l as f,b as y,u as k,o as c,t as w,O as M}from"./app.c92ae819.js";import{_ as j}from"./InputError.1fe86f6e.js";const S={class:"grid md:grid-cols-3 lg:grid-cols-5 gap-5"},C={class:"relative py-3 px-2 flex flex-col items-center justify-center border border-gray-300 rounded-3xl shadow-xl"},B=e("i",{class:"fa-duotone fa-file text-gray-400 text-5xl"},null,-1),D={class:"text-center mt-2"},F={class:"block text-sm font-medium text-gray-900"},I=["href","download"],N=["onClick"],O={class:""},P={class:"block h-full"},L=["onClick"],R=e("i",{class:"fa-duotone fa-file text-gray-400 text-5xl"},null,-1),T=e("span",{class:"mt-2 block text-sm font-medium text-gray-900"},"Tambah Media",-1),V=e("p",{class:"text-gray-500 text-xs font-semibold"}," * any extension ",-1),$=[R,T,V],z={__name:"MediaSection",props:{project:Object},setup(_){const r=_,a=g({id:r.project.id,media:null}),n=u(null),t=u(null),p=()=>{t.value&&(a.media=t.value.files[0]),a.post(route("project.addMedia"),{errorBag:"storeMedia",preserveScroll:!0,onSuccess:()=>{n.value=null,d(),a.reset()}})},m=()=>{t.value.click()},x=()=>{const s=t.value.files[0];if(!s)return;const l=new FileReader;l.onload=o=>{n.value=o.target.result},l.readAsDataURL(s),p()},h=(s,l)=>{M.delete(route("project.deleteMedia",l),{preserveScroll:!0,onSuccess:()=>{n.value=null,d()}})},d=()=>{var s;(s=t.value)!=null&&s.value&&(t.value.value=null)};return(s,l)=>(c(),i("div",S,[(c(!0),i(v,null,b(r.project.media,(o,A)=>(c(),i("div",C,[B,e("div",D,[e("p",F,w(o.file_name),1),e("a",{type:"button",href:o.original_url,download:o.file_name,class:"text-primary-600 text-xs font-semibold"}," Download ",8,I),e("button",{class:"text-red-600 text-xs font-semibold",onClick:f(E=>h(r.project.id,o.id),["prevent"])}," Delete ",8,N)])]))),256)),e("div",O,[e("input",{ref_key:"mediaInput",ref:t,type:"file",class:"hidden",onChange:x},null,544),e("div",P,[e("button",{onClick:f(m,["prevent"]),type:"button",class:"relative py-3 px-2 flex flex-col justify-center items-center w-full h-full text-center border-2 border-gray-400 border-dashed focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-2xl shadow-sm"},$,8,L)]),y(j,{message:k(a).errors.media,class:"mt-2"},null,8,["message"])])]))}};export{z as default};
