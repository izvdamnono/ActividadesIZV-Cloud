#!/bin/bash
#Antonio Mudarra Machuca
#Git commit and push
$text_commit = $1

if [ -z "$text_commit" ] 
    then
    git add . 
    git commit -m "$text_commit"
    echo "commit"
    git push -u origin master
    echo "push"
fi