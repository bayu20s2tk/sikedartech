import{T as V,c as b,w as r,o as v,g as n,a as c,b as o,u as s,n as S}from"./app.c8c93927.js";import{_ as k}from"./ActionMessage.eebb4e36.js";import{_ as w}from"./FormSection.3edd22db.js";import{_ as m}from"./InputError.4d9653d8.js";import{_ as i}from"./InputLabel.cbe30963.js";import{_ as $}from"./PrimaryButton.a52668c4.js";import{_}from"./TextInput.bdbad600.js";import{_ as x}from"./TextAreaInput.a976d03e.js";import"./SectionTitle.73b769fb.js";import"./_plugin-vue_export-helper.cdc0426e.js";const B={class:"col-span-6 sm:col-span-4"},I={class:"col-span-6 sm:col-span-5"},U={class:"col-span-6 sm:col-span-3"},O={__name:"UpdateInformationForm",props:{category:Object|String},setup(g){var d,p,f;const t=g,e=V({name:(d=t.category.name)!=null?d:null,desc:(p=t.category.desc)!=null?p:null,icon:(f=t.category.icon)!=null?f:null}),y=()=>{t.category.name==null?e.post(route("courseCategory.store"),{errorBag:"storeInformation",preserveScroll:!0,onSuccess:()=>u()}):e.put(route("courseCategory.update",t.category),{errorBag:"updateInformation",preserveScroll:!0,onSuccess:()=>u()})},u=()=>{};return(C,a)=>(v(),b(w,{onSubmitted:y},{title:r(()=>[n(" Kategori Kursus ")]),description:r(()=>[n(" Update your account's profile information and email address. ")]),form:r(()=>[c("div",B,[o(i,{for:"name",value:"Judul"}),o(_,{id:"name",modelValue:s(e).name,"onUpdate:modelValue":a[0]||(a[0]=l=>s(e).name=l),type:"text",class:"mt-1 block w-full",autocomplete:"name",required:""},null,8,["modelValue"]),o(m,{message:s(e).errors.name,class:"mt-2"},null,8,["message"])]),c("div",I,[o(i,{for:"desc",value:"Deskripsi"}),o(x,{id:"desc",modelValue:s(e).desc,"onUpdate:modelValue":a[1]||(a[1]=l=>s(e).desc=l),class:"mt-1 block w-full",rows:"2",required:""},null,8,["modelValue"]),o(m,{message:s(e).errors.desc,class:"mt-2"},null,8,["message"])]),c("div",U,[o(i,{for:"icon",value:"Ikon"}),o(_,{id:"icon",modelValue:s(e).icon,"onUpdate:modelValue":a[2]||(a[2]=l=>s(e).icon=l),type:"text",class:"mt-1 block w-full",autocomplete:"icon",required:""},null,8,["modelValue"]),o(m,{message:s(e).errors.icon,class:"mt-2"},null,8,["message"])])]),actions:r(()=>[o(k,{on:s(e).recentlySuccessful,class:"mr-3"},{default:r(()=>[n(" Berhasil disimpan. ")]),_:1},8,["on"]),o($,{class:S({"opacity-25":s(e).processing}),disabled:s(e).processing},{default:r(()=>[n(" Simpan ")]),_:1},8,["class","disabled"])]),_:1}))}};export{O as default};
