import{T as P,d as y,c as s,w as c,o as r,b as k,a as t,t as u,e as n,g as p,f as l,F as f,u as h,j as v,h as I,n as _}from"./app.c66173a4.js";import{h as w}from"./moment.9709ab41.js";import{_ as b}from"./PrimaryButton.a2108093.js";import{_ as N}from"./AppLayout.3831ff0a.js";import{_ as T}from"./PreviousButton.ed915f40.js";import V from"./BidList.a4b1567b.js";import H from"./ChatSection.fc9f28c0.js";import M from"./MediaSection.8cb89881.js";import{_ as O}from"./DangerButton.b0ef2b0a.js";import R from"./ProgressSection.2e12b3f4.js";import $ from"./SummarySection.973c4c48.js";import z from"./PaymentModal.ef93a607.js";import F from"./WorkerAlert.55395c43.js";import C from"./ReviewSection.25852262.js";import"./Banner.517fcbee.js";import"./DarkmodeToggle.fb1b0a00.js";import"./helper.e9fc3b37.js";import"./transition.6c7c35ad.js";import"./Badge.ba879c84.js";import"./moment.7a7b8ba5.js";import"./InputError.6f56a6d9.js";import"./TextInput.cc0ffd6a.js";import"./InputLabel.9b9d421d.js";import"./TextAreaInput.485175ed.js";import"./ActionSection.e8d8a41d.js";import"./SectionTitle.658b2d17.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./DialogModal.e71578ca.js";import"./SecondaryButton.415c187e.js";const A={class:"max-w-7xl mx-auto items-start"},E={class:"flex justify-between gap-3"},L={class:""},U={class:"text-xl font-medium leading-6 text-gray-900"},W={class:"flex items-center gap-2"},Y=t("i",{class:"fa-duotone fa-check mr-2"},null,-1),q=t("i",{class:"fa-duotone fa-paper-plane mr-2"},null,-1),G={class:"mt-5 grid grid-cols-1 divide-y divide-gray-300 dark:divide-gray-600 border border-gray-300 overflow-hidden rounded-3xl bg-white bg-opacity-50 shadow-lg md:grid-cols-4 md:divide-y-0 md:divide-x"},J={class:"px-4 py-5 sm:p-6"},K=t("dt",{class:"text-base font-normal text-gray-900"},"Status",-1),Q={class:"mt-1 flex items-baseline justify-between md:block lg:flex"},X={class:"flex items-baseline text-2xl font-semibold text-primary-600"},Z=t("span",{class:"ml-2 text-sm font-medium text-gray-500"},null,-1),ee={class:"px-4 py-5 sm:p-6"},te=t("dt",{class:"text-base font-normal text-gray-900"},"Deadline",-1),re={class:"mt-1 flex items-baseline justify-between md:block lg:flex"},se={class:"flex items-baseline text-2xl font-semibold text-primary-600"},oe={class:"ml-2 text-sm font-medium text-gray-500"},ae={class:"px-4 py-5 sm:p-6"},ie=t("dt",{class:"text-base font-normal text-gray-900"},"Worker",-1),de={class:"mt-1 flex items-baseline justify-between md:block lg:flex"},le={class:"flex items-baseline text-2xl font-semibold text-primary-600"},ne={key:1},ce=t("span",{class:"ml-2 text-sm font-medium text-gray-500"},null,-1),pe={class:"px-4 py-5 sm:p-6"},me=t("dt",{class:"text-base font-normal text-gray-900"},"Owner",-1),ue={class:"mt-1 flex items-baseline justify-between md:block lg:flex"},_e={class:"flex items-baseline text-2xl font-semibold text-primary-600"},fe=t("span",{class:"ml-2 text-sm font-medium text-gray-500"},null,-1),ye={class:"mt-10 text-sm font-medium leading-6 text-gray-900"},be={class:"rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl border border-gray-300 overflow-hidden shadow-lg"},xe={role:"list",class:"divide-y divide-gray-300 dark:divide-gray-600"},je={key:4,class:"my-10"},ge={class:"sticky top-0 z-40 backdrop-blur border-b border-gray-200 mb-10"},ke={class:"-mb-px flex","aria-label":"Tabs"},he={key:4,class:""},Xe={__name:"Show",props:{project:Object,chat:Object},setup(S){const e=S,m=P({status_id:null,deadline_date:null}),x=a=>{e.project.status_id==2&&(m.deadline_date=w().add(e.project.finish_day,"days").format()),m.status_id=a,m.patch(route("project.update",e.project),{errorBag:"storeInformation",preserveScroll:!0,onSuccess:()=>{m.reset()}})},B=()=>{m.status_id=0,m.patch(route("project.update",e.project),{errorBag:"storeInformation",preserveScroll:!0,onSuccess:()=>{m.reset()}})};y(null);function D(a){return w(a).format("DD MMM Y HH:mm")}const o=y(1);return y(!1),(a,i)=>(r(),s(N,{title:"Proyek",name:"Proyek",desc:"lorem ipsum"},{previous:c(()=>[k(T)]),default:c(()=>{var j,g;return[t("div",A,[t("div",E,[t("div",L,[t("h1",U,u(e.project.name),1)]),t("div",W,[e.project.user_id==a.$page.props.user.id||a.$page.props.user.role_id==1?(r(),n(f,{key:0},[e.project.status_id==0||e.project.status_id==1?(r(),s(O,{key:0,onClick:B},{default:c(()=>[p(" Cancel ")]),_:1})):l("",!0),e.project.status_id==0||e.project.status_id==1?(r(),s(b,{key:1,as:"a",href:a.route("project.edit",e.project)},{default:c(()=>[p(" Ubah Data ")]),_:1},8,["href"])):l("",!0),e.project.status_id==3?(r(),s(b,{key:2,onClick:i[0]||(i[0]=d=>x(4))},{default:c(()=>[Y,p(" Proyek Selesai ")]),_:1})):l("",!0)],64)):l("",!0),a.$page.props.user.role_id==1?(r(),n(f,{key:1},[e.project.status_id==0?(r(),s(b,{key:0,onClick:i[1]||(i[1]=d=>x(1))},{default:c(()=>[q,p(" Approve ")]),_:1})):l("",!0)],64)):l("",!0)])]),t("div",null,[t("dl",G,[t("div",J,[K,t("dd",Q,[t("div",X,[p(u(e.project.status)+" ",1),Z])])]),t("div",ee,[te,t("dd",re,[t("div",se,[p(u(e.project.finish_day)+" Hari ",1),t("span",oe," / "+u(D((j=e.project)==null?void 0:j.deadline_date)),1)])])]),t("div",ae,[ie,t("dd",de,[t("div",le,[e.project.worker?(r(),s(h(v),{key:0,href:a.route("user.show",e.project.worker)},{default:c(()=>{var d;return[p(u((d=e.project.worker)==null?void 0:d.name),1)]}),_:1},8,["href"])):(r(),n("span",ne," - ")),ce])])]),t("div",pe,[me,t("dd",ue,[t("div",_e,[k(h(v),{href:a.route("user.show",e.project.user)},{default:c(()=>{var d;return[p(u((d=e.project.user)==null?void 0:d.name),1)]}),_:1},8,["href"]),fe])])])])]),e.project.status_id==2&&e.project.user.id==a.$page.props.user.id||e.project.status_id==2&&a.$page.props.user.role_id==1?(r(),s(z,{key:0,project:e.project},null,8,["project"])):l("",!0),e.project.status_id==2&&((g=e.project.worker)==null?void 0:g.id)==a.$page.props.user.id?(r(),s(F,{key:1})):l("",!0),e.project.status_id==0?(r(),s($,{key:2,class:"mt-10",project:e.project},null,8,["project"])):e.project.status_id==1?(r(),n(f,{key:3},[t("h1",ye,"Total bids "+u(e.project.bid.length),1),t("div",be,[t("ul",xe,[(r(!0),n(f,null,I(e.project.bid,d=>(r(),s(V,{bid:d},null,8,["bid"]))),256))])])],64)):(r(),n("div",je,[t("div",ge,[t("nav",ke,[t("button",{class:_(["w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm",o.value==1?"border-primary-600 text-primary-600":"text-gray-500 border-gray-300"]),onClick:i[2]||(i[2]=d=>o.value=1)}," Ringkasann ",2),e.project.status_id!=2?(r(),n("button",{key:0,class:_(["w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm",o.value==2?"border-cyan-600 text-cyan-600":"text-gray-500 border-gray-300 "]),onClick:i[3]||(i[3]=d=>o.value=2)}," Resources ",2)):l("",!0),t("button",{class:_(["w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm",o.value==3?"border-green-600 text-green-600":"text-gray-500 border-gray-300 "]),onClick:i[4]||(i[4]=d=>o.value=3)}," Conversation ",2),e.project.status_id!=2?(r(),n("button",{key:1,class:_(["w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm",o.value==4?"border-sky-600 text-sky-600":"text-gray-500 border-gray-300 "]),onClick:i[5]||(i[5]=d=>o.value=4)}," Progress ",2)):l("",!0),e.project.status_id>=4?(r(),n("button",{key:2,class:_(["w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm",o.value==5?"border-sky-600 text-sky-600":"text-gray-500 border-gray-300 "]),onClick:i[6]||(i[6]=d=>o.value=5)}," Review ",2)):l("",!0)])]),o.value==1?(r(),s($,{key:0,project:e.project},null,8,["project"])):o.value==2?(r(),s(M,{key:1,project:e.project},null,8,["project"])):o.value==3?(r(),s(H,{key:2,project:e.project,chat:e.chat},null,8,["project","chat"])):o.value==4?(r(),s(R,{key:3,project:e.project},null,8,["project"])):o.value==5?(r(),n("div",he,[e.project.user.id==a.$page.props.user.id?(r(),s(C,{key:0,worker_id:e.project.worker.id,project:e.project},null,8,["worker_id","project"])):l("",!0),e.project.worker.id==a.$page.props.user.id?(r(),s(C,{key:1,owner_id:e.project.user.id,project:e.project},null,8,["owner_id","project"])):l("",!0)])):l("",!0)]))])]}),_:1}))}};export{Xe as default};
