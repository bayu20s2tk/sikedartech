import{T as j,c as x,w as l,o as $,g as n,a as m,b as s,u as o,n as k}from"./app.c8c93927.js";import{_ as w}from"./ActionMessage.eebb4e36.js";import{_ as S}from"./FormSection.3edd22db.js";import{_ as c}from"./InputError.4d9653d8.js";import{_ as d}from"./InputLabel.cbe30963.js";import{_ as B}from"./PrimaryButton.a52668c4.js";import{_ as b}from"./TextInput.bdbad600.js";import{_ as U}from"./SelectInput.3545045c.js";import{_ as I}from"./EditorInput.77d29f46.js";import"./SectionTitle.73b769fb.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./tippy.aecf4262.js";import"./DialogModal.9dee1c62.js";import"./DangerButton.1e98f627.js";const h={class:"col-span-6 sm:col-span-4"},C={class:"col-span-6"},N={class:"col-span-6 sm:col-span-2"},q={class:"flex"},O=m("span",{class:"flex items-center bg-white text-black border border-gray-300 border-r-0 rounded-3xl rounded-r-none shadow-sm mt-1 px-3"},"Rp",-1),P={class:"col-span-6 sm:col-span-3"},W={__name:"UpdateInformationForm",props:{project:Object|String,gallery:Object},setup(y){var u,p,f,_,g;const r=y,e=j({name:(u=r.project.name)!=null?u:null,desc:(p=r.project.desc)!=null?p:null,budget_from:(f=r.project.budget_from)!=null?f:null,budget_to:(_=r.project.budget_to)!=null?_:null,category_id:(g=r.project.category_id)!=null?g:null}),v=()=>{r.project.name==null?e.post(route("project.store"),{errorBag:"storeInformation",preserveScroll:!0,onSuccess:()=>i()}):e.put(route("project.update",r.project),{errorBag:"updateInformation",preserveScroll:!0,onSuccess:()=>i()})},i=()=>{};return(V,a)=>($(),x(S,{onSubmitted:v},{title:l(()=>[n(" Informasi Proyek ")]),description:l(()=>[n(" Update your account's profile information and email address. ")]),form:l(()=>[m("div",h,[s(d,{for:"name",value:"Judul"}),s(b,{id:"name",modelValue:o(e).name,"onUpdate:modelValue":a[0]||(a[0]=t=>o(e).name=t),type:"text",class:"mt-1 block w-full",autocomplete:"name",required:""},null,8,["modelValue"]),s(c,{message:o(e).errors.name,class:"mt-2"},null,8,["message"])]),m("div",C,[s(d,{for:"desc",value:"Deskripsi"}),s(I,{modelValue:o(e).desc,"onUpdate:modelValue":a[1]||(a[1]=t=>o(e).desc=t),gallery:r.gallery},null,8,["modelValue","gallery"]),s(c,{message:o(e).errors.desc,class:"mt-2"},null,8,["message"])]),m("div",N,[s(d,{for:"price",value:"Budget mulai dari"}),m("div",q,[O,s(b,{id:"price",modelValue:o(e).budget_from,"onUpdate:modelValue":a[2]||(a[2]=t=>o(e).budget_from=t),type:"number",class:"mt-1 block w-full rounded-l-none"},null,8,["modelValue"])]),s(c,{message:o(e).errors.budget_from,class:"mt-2"},null,8,["message"])]),m("div",P,[s(d,{for:"category",value:"Kategori"}),s(U,{id:"category","model-value":o(e).category_id,"onUpdate:modelValue":a[3]||(a[3]=t=>o(e).category_id=t),"model-valueModifiers":{number:!0},option:V.$page.props.selectCategory,class:"mt-1 block w-full",required:""},null,8,["model-value","option"]),s(c,{message:o(e).errors.category_id,class:"mt-2"},null,8,["message"])])]),actions:l(()=>[s(w,{on:o(e).recentlySuccessful,class:"mr-3"},{default:l(()=>[n(" Berhasil disimpan. ")]),_:1},8,["on"]),s(B,{class:k({"opacity-25":o(e).processing}),disabled:o(e).processing},{default:l(()=>[n(" Simpan ")]),_:1},8,["class","disabled"])]),_:1}))}};export{W as default};