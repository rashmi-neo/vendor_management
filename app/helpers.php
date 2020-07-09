<?php
use App\Model\Requirement;

 function getRequirementCode()
  {
    $lastRequirementCode  =   Requirement::orderBy('created_at', 'desc')->first();

    // $var = 'VMS00098';
    // $lastRequirementCode->code = $var ;

    if(isset($lastRequirementCode) && !empty($lastRequirementCode))
    {
        $requirementCode = preg_replace("/[^0-9]/", "",$lastRequirementCode->code);
        $code = 'VMS'.str_pad((int)$requirementCode + 1, 5, "0", STR_PAD_LEFT);
        return $code;
    }
    else
    {
        $code = 'VMS'.str_pad(0 + 1, 5, "0", STR_PAD_LEFT);
        return $code;
    }
  }

    function uploadFile($document,$url)
    {
        $path = Config::get('constants.UPLOAD_PATH');
       
        $destinationPath = $path['path'].$url;
    
        if(!is_dir($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        if(isset($document))
        {
            $extension = $document->getClientOriginalExtension();
            $documentOriginalName = $document->getClientOriginalName();
            $documentName = md5(uniqid($documentOriginalName)).'.'.$extension;
            $document->move($destinationPath, $documentName);
        }
        return $documentName;
    }

