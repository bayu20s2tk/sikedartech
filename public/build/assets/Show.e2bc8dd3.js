import{_ as n}from"./AppLayout.c5b88607.js";import c from"./DeleteUserForm.0b5b4f79.js";import u from"./LogoutOtherBrowserSessionsForm.4631c3ae.js";import{S as a}from"./SectionBorder.ee4b8b62.js";import f from"./TwoFactorAuthenticationForm.f453670e.js";import l from"./UpdatePasswordForm.ec104905.js";import $ from"./UpdateProfileInformationForm.35dbb776.js";import{c as _,w as p,o,b as r,e as t,F as s,f as i}from"./app.52827ccf.js";import{_ as g}from"./PreviousButton.897ad2cf.js";import"./DarkmodeToggle.1cee4b19.js";import"./helper.e9fc3b37.js";import"./ActionSection.82b63fa7.js";import"./SectionTitle.d6fffc49.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./DangerButton.ef18f455.js";import"./DialogModal.b9b06c15.js";import"./InputError.0ab7e727.js";import"./SecondaryButton.5f9bf709.js";import"./TextInput.434d3486.js";import"./ActionMessage.19b5e222.js";import"./PrimaryButton.0a585a1e.js";import"./InputLabel.37b814a3.js";import"./FormSection.c009e484.js";const G={__name:"Show",props:{confirmsTwoFactorAuthentication:Boolean,sessions:Array},setup(m){return(e,d)=>(o(),_(n,{title:e.$page.props.user.name,name:e.$page.props.user.name,desc:e.$page.props.user.email,avatar:e.$page.props.user.profile_photo_url},{previous:p(()=>[r(g)]),default:p(()=>[e.$page.props.jetstream.canUpdateProfileInformation?(o(),t(s,{key:0},[r($,{user:e.$page.props.user},null,8,["user"]),r(a)],64)):i("",!0),e.$page.props.jetstream.canUpdatePassword?(o(),t(s,{key:1},[r(l),r(a)],64)):i("",!0),e.$page.props.jetstream.canManageTwoFactorAuthentication?(o(),t(s,{key:2},[r(f,{"requires-confirmation":m.confirmsTwoFactorAuthentication},null,8,["requires-confirmation"]),r(a)],64)):i("",!0),r(u,{sessions:m.sessions},null,8,["sessions"]),e.$page.props.jetstream.hasAccountDeletionFeatures?(o(),t(s,{key:3},[r(a),r(c)],64)):i("",!0)]),_:1},8,["title","name","desc","avatar"]))}};export{G as default};