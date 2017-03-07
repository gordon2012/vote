SetTimer, UPDATEDSCRIPT, 1000
UPDATEDSCRIPT:
   FileGetAttrib,attribs,%A_ScriptFullPath%
   IfInString,attribs,A
   {
      FileSetAttrib,-A,%A_ScriptFullPath%
      posX = %A_CaretX%
      posY = %A_CaretY%
      ToolTip,Updated script,%posX%,%posY%
      Sleep,500
      Reload
   }
Return

!q::
    Send, ^c
    FoundPos := RegExMatch(Clipboard, "(.* )([#]\d*)", SP)
    Clipboard = git commit -m "%SP1%(Closes %SP2%)"

    WinActivate, Hyper

    SendRaw, %Clipboard%

Return

!w::
    WinActivate, Hyper
    SendRaw, git commit --amend --no-edit --date=""
Return

!r::
    Send, ^c
    
    StringReplace, OutText, Clipboard, %A_SPACE%, -, All
    StringLower, OutText, OutText
    
    Clipboard = git checkout -b %OutText%

    WinActivate, Hyper
    SendRaw, %Clipboard%
Return