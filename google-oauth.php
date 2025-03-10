<?php 
session_start();

$clientSecret = file_get_contents('./client_secret.json');
$clientSecretObj = json_decode($clientSecret);
$google_oauth_version = 'v3';

//jeśli mamy nie pusty kod to musimy go "wymienić" na token
if (isset($_GET['code']) && !empty($_GET['code'])){
    $params = [
        'code' => $_GET['code'],
        'client_id' => $clientSecretObj->web->client_id,
        'client_secret'=>$clientSecretObj->web->client_secret,
        'redirect_uri'=>$clientSecretObj->web->redirect_uris[0],
        'grant_type' => 'authorization_code'
    ];
   
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$clientSecretObj->web->token_uri);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response, true);
    
    if (isset($response['access_token']) && !empty($response['access_token'])) {
        //jak jest odpowiedź i mamy token
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/oauth2/' . $google_oauth_version . '/userinfo');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $response['access_token']]);
        $response = curl_exec($ch);
        curl_close($ch);
        $profile = json_decode($response, true);
        $google_name_parts = [];
        $google_name_parts[] = isset($profile['given_name']) ? preg_replace('/[^a-zA-Z0-9]/s', '', $profile['given_name']) : '';
        $google_name_parts[] = isset($profile['family_name']) ? preg_replace('/[^a-zA-Z0-9]/s', '', $profile['family_name']) : '';
        // Authenticate the user
        session_regenerate_id();
        $_SESSION['google_loggedin'] = TRUE;
        $_SESSION['google_email'] = $profile['email'];
        $_SESSION['google_name'] = implode(' ', $google_name_parts);
        $_SESSION['google_picture'] = isset($profile['picture']) ? $profile['picture'] : '';
        header('Location: index.php');
    }
} else {
    $params = [
        'response_type' => 'code',
        'client_id' => $clientSecretObj->web->client_id,
        'redirect_uri' => $clientSecretObj->web->redirect_uris[0],
        'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
        'access_type' => 'offline',
        'prompt' => 'consent'
    ];
    header('Location: https://accounts.google.com/o/oauth2/auth?' . http_build_query($params));
    exit;
}


?>