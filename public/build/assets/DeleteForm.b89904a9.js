import{d as n,T as m,c as l,w as a,o as d,g as e,a as t,b as i}from"./app.5add3a04.js";import{_ as p}from"./ActionSection.cc41e0a4.js";import{_ as u}from"./DangerButton.28ef7d30.js";import"./SectionTitle.03fae6e9.js";import"./_plugin-vue_export-helper.cdc0426e.js";const _=t("div",{class:"max-w-xl text-sm text-gray-600"}," Setelah halaman dihapus, semua sumber daya dan datanya akan dihapus secara permanen. ",-1),f={class:"mt-5"},v={__name:"DeleteForm",props:{course:Object},setup(r){const s=r;n(null);const o=m({id:s.course.id}),c=()=>{o.delete(route("course.destroy",s.course),{preserveScroll:!0})};return(h,x)=>(d(),l(p,null,{title:a(()=>[e(" Hapus Halaman ")]),description:a(()=>[e(" Hapus halaman secara permanen ")]),content:a(()=>[_,t("div",f,[i(u,{class:"",onClick:c},{default:a(()=>[e(" Hapus halaman ")]),_:1})])]),_:1}))}};export{v as default};