import{d as i,c,w as o,o as l,b as a,a as t,t as e,g as n}from"./app.c92ae819.js";import"./moment.9709ab41.js";import{_ as m}from"./PrimaryButton.9d1e96f7.js";import{_}from"./AppLayout.34d12576.js";import{_ as u}from"./PreviousButton.969cd901.js";import"./DarkmodeToggle.dc06d172.js";import"./helper.e9fc3b37.js";import"./transition.2beecb45.js";const h={class:"max-w-7xl mx-auto items-start"},g={class:"flex justify-between gap-3"},x={class:""},p={class:"text-xl font-medium leading-6 text-gray-900"},f={class:""},b={class:"mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3"},y={class:"overflow-hidden rounded-3xl bg-white bg-opacity-50 px-4 py-5 shadow-lg border border-gray-300"},w=t("dt",{class:"truncate text-sm font-medium text-gray-500"},"Status",-1),v={class:"mt-1 text-xl font-semibold tracking-tight text-gray-900"},k={class:"overflow-hidden rounded-3xl bg-white bg-opacity-50 px-4 py-5 shadow-lg border border-gray-300"},N=t("dt",{class:"truncate text-sm font-medium text-gray-500"},"Total Member",-1),B={class:"mt-1 text-xl font-semibold tracking-tight text-gray-900"},S={class:"overflow-hidden rounded-3xl bg-white bg-opacity-50 px-4 py-5 shadow-lg border border-gray-300"},V=t("dt",{class:"truncate text-sm font-medium text-gray-500"},"Author",-1),$={class:"mt-1 text-xl font-semibold tracking-tight text-gray-900 flex items-center"},q={__name:"Show",props:{course:Object,subscriber:Number},setup(r){const s=r;return i(null),(d,j)=>(l(),c(_,{title:"Kelas",name:"Kelas",desc:"lorem ipsum"},{previous:o(()=>[a(u)]),default:o(()=>[t("div",h,[t("div",g,[t("div",x,[t("h1",p,e(s.course.name),1)]),t("div",f,[a(m,{as:"a",href:d.route("course.edit",s.course)},{default:o(()=>[n("Ubah Data")]),_:1},8,["href"])])]),t("div",null,[t("dl",b,[t("div",y,[w,t("dd",v,e(s.course.status),1)]),t("div",k,[N,t("dd",B,e(s.subscriber),1)]),t("div",S,[V,t("dd",$,e(s.course.user.name),1)])])])])]),_:1}))}};export{q as default};