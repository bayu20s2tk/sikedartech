import{d as r,c as u,w as i,o as _,a as e,b as t,g as f}from"./app.894b1448.js";import{_ as p}from"./AppLayout.b7304456.js";import{_ as g}from"./PrimaryButton.24da5572.js";import{_ as h}from"./TextInput.d4599905.js";import{_ as y}from"./Table.cece8fc5.js";import"./DarkmodeToggle.3f20da9a.js";import"./helper.e9fc3b37.js";import"./transition.0c07d6ec.js";const v={class:"flex justify-between gap-3"},w={class:""},b={id:"search"},x={class:""},j={__name:"Index",props:{category:Object|String},setup(l){const s=l,a=r(""),c=["Nama","Keterangan"],n=["name","desc"];return r(""),(m,o)=>(_(),u(p,{title:"Kategori Kelas",name:"Kategori Kelas",desc:"lorem ipsum"},{default:i(()=>[e("div",v,[e("div",w,[e("form",b,[t(h,{name:"query",modelValue:a.value,"onUpdate:modelValue":o[0]||(o[0]=d=>a.value=d),type:"text",class:"block w-full lg:w-96 mb-5 shadow",placeholder:"Cari disini"},null,8,["modelValue"])])]),e("div",x,[t(g,{as:"a",href:m.route("courseCategory.create")},{default:i(()=>[f("Tambah")]),_:1},8,["href"])])]),t(y,{title:c,data:s.category.data,paginate:s.category,columns:n,"filter-key":a.value,routes:"courseCategory",slug:!1,view:!1,edit:!0},null,8,["data","paginate","filter-key"])]),_:1}))}};export{j as default};
