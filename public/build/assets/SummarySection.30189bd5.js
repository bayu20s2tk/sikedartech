import"./moment.7a7b8ba5.js";import{e as r,a as t,t as e,o as n}from"./app.c66173a4.js";const i={class:"overflow-hidden bg-white bg-opacity-50 shadow-lg rounded-3xl border border-gray-300"},l=t("div",{class:"px-4 py-5 sm:px-6"},[t("h3",{class:"text-lg font-medium leading-6 text-gray-900"},"Ringkasann"),t("p",{class:"mt-1 max-w-2xl text-sm text-gray-500"},"Personal details and application.")],-1),m={class:"border-t border-gray-200 px-4 py-5 sm:px-6"},_={class:"grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2"},x={class:"sm:col-span-2"},p=t("dt",{class:"text-sm font-medium text-gray-500"},"Kelas",-1),g={class:"mt-1 text-sm text-gray-900"},h={class:"sm:col-span-1"},u=t("dt",{class:"text-sm font-medium text-gray-500"},"Owner",-1),y={class:"mt-1 text-sm text-gray-900"},f={class:"sm:col-span-1"},v=t("dt",{class:"text-sm font-medium text-gray-500"},"Harga Kelas",-1),b={class:"mt-1 text-sm text-gray-900"},w={class:"sm:col-span-2"},B=t("dt",{class:"text-sm font-medium text-gray-500"},"Keterangan",-1),S=["innerHTML"],K={__name:"SummarySection",props:{course:Object},setup(a){const s=a;function c(o){return(o/1).toFixed(0).replace(".","").toString().replace(/\B(?=(\d{3})+(?!\d))/g,".")}return(o,d)=>(n(),r("div",i,[l,t("div",m,[t("dl",_,[t("div",x,[p,t("dd",g,e(s.course.name),1)]),t("div",h,[u,t("dd",y,e(s.course.user.name),1)]),t("div",f,[v,t("dd",b,"Rp "+e(c(s.course.price)),1)]),t("div",w,[B,t("dd",{class:"mt-1 text-sm text-gray-900",innerHTML:s.course.desc},null,8,S)])])])]))}};export{K as default};
