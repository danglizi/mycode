#InstallKeybdHook
~LButton::
Sleep 50
   MouseGetPos, xx,yy,id, kongjian
;ToolTip,"%kongjian%"
WinGetClass, class, A
;ToolTip, The active window's class is "%class%".
if (kongjian = "SysListView321") or  RegExMatch(kongjian, "Edit") or (kongjian = "Static99")  
{
PostMessage, 0x0050, 1, 0x8040804,, , A ; 中文输入法代码0x8040804
;ToolTip,"切换成中文模式“
}

else if RegExMatch(kongjian, "Afx:") or RegExMatch(kongjian, "AfxFrameOrView140u1")  or  RegExMatch(kongjian, "RichEditD2DPT") or  RegExMatch(kongjian, " GXEDIT") 
{
PostMessage, 0x0050, 1, 0x4090409,, , A ; 英文输入法代码 0x4090409
;ToolTip,"切换成英文文模式”

}
else if WinActive("ahk_class #32770")  or WinActive("ahk_class PSFloatC") or  WinActive("ahk_exe WeChat.exe")
{
   PostMessage, 0x0050, 1, 0x8040804,, , A ;英文输入法代码0x4090409 中文输入法0x8040804
}
return
   MouseGetPos, xx,yy,id, kongjian
;ToolTip,"%kongjian%"

return

Browser_Home::esc
Browser_Search::Q
Media_Prev::F6
Media_Play_Pause::F7
Media_Next::F8
Volume_Down::F9
Volume_Up::F10
ctrl & F13::^z
ctrl & F14::^x
ctrl & F15::^c
ctrl & F16::^v
ctrl & F17::^a
ctrl & F18::^s
 F13 & 1::send 12345678
F13 & 2::send 12345678
Joy1 &  F24::send 654321
 
 
return
#IfWinActive ahk_exe msedge.exe
alt & F13::run quicker:runaction:1b820581-716a-4092-bbcb-4c85cfb84477 ;运行获取图名和ID
alt & F14::run quicker:runaction:e9068c46-5d88-4e23-bc37-d446d9d5e13e ;截取游戏截图

#IfWinActive ahk_exe WeChat.exe
F1::run quicker:runaction:bedcb84e-aef0-47c9-874f-01f13e707a0c
#IfWinActive RegExMatch(kongjian, "Afx:")  and WinActive("ahk_exe revit.exe")
;修改类


Ctrl & RButton::send tr
Ctrl & MButton::send sl
Ctrl & WheelUp::send tt
Ctrl & WheelDown::send ty

Z & LButton::send wa     
Z & RButton::send lb     
Z & MButton::send tt 
Z & WheelUp::send mm
Z & WheelDown::send dm
Z & XButton1::send ma

X & LButton::send cm
X & RButton::send lb
X & MButton::send st
X & WheelUp::send wg
X & WheelDown::send lt

C & LButton::send bm
C & RButton::send sb
C & MButton::send w2
C & WheelUp::send db
C & WheelDown::send dj

V & LButton::send in
V & RButton::send lr
V & MButton::send lj
V & WheelUp::send mn
V & WheelDown::send mj

A & LButton::send sl
A & RButton::send sw
A & MButton::send ro
A & WheelUp::send mn
A & WheelDown::send mj

S & LButton::send hi
S & RButton::send hh
S & MButton::send hr
S & WheelUp::send tb
S & WheelDown::send lp


#If  RegExMatch(kongjian, "Afx:")  and  WinActive("ahk_exe rhino.exe") 
z::z
x::x
c::c
v::v
a::a
s::s
d::d
f::f
q::q
w::w
e::e
r::r
t::t
g::g
b::b

Z & LButton::send tr{enter}
Z & RButton::send as{enter}
Z & MButton::send tt{enter}
Z & WheelUp::send mm{enter}
Z & WheelDown::send dm{enter}
Z & XButton1::send ma{enter}

X & LButton::send cm{enter}
X & RButton::send lb{enter}
X & MButton::send st{enter}
X & WheelUp::send wg{enter}
X & WheelDown::send lt{enter}

C & LButton::send rec{enter}
C & RButton::send arc{enter}
C & MButton::send da{enter}
C & WheelUp::send pl{enter}
C & WheelDown::send po{enter}

V & LButton::send in{enter}
V & RButton::send lr{enter}
V & MButton::send lj{enter}
V & WheelUp::send mn{enter}
V & WheelDown::send mj{enter}

A & LButton::send sl{enter}
A & RButton::send sw{enter}
A & MButton::send ro{enter}
A & WheelUp::send mn{enter}
A & WheelDown::send mj{enter}

S & LButton::send hi{enter}
S & RButton::send h{enter}
S & MButton::send hh{enter}
S & WheelUp::send tb{enter}
S & WheelDown::send lp{enter}
