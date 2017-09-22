<?php
/*
------------------
Language: Francais
------------------
*/
 
$lang = array();
 
//Login

$lang['LOGIN_NAME'] = 'Enter name and hit enter';
$lang['LOGIN_PASS'] = 'Enter password and hit enter';
$lang['LOGIN_SOUV'] = 'Keep me logged in';
$lang['LOGIN_ERR_NAME_1'] = 'DATA Error: Unknown name from CWU Data Base';
$lang['LOGIN_ERR_NAME_2'] = 'DATA Error: Full name required (First name and last name)';
$lang['LOGIN_ERR_EMAIL_1'] = 'DATA Error: Unknown email from CWU Admins Data Base';
$lang['LOGIN_ERR_MDP_1'] = 'DATA Error: The password does not match,';

// Dashbord
 
$lang['DASH_TITLE'] = 'Dashbord';
$lang['DASH_WELCOME'] = 'Welcome';
$lang['DASH_ADD'] = 'Add Record';
$lang['DASH_SEARCH'] = 'Search Record';
$lang['DASH_LOGOUT'] = 'Log Out';
$lang['DASH_BEFORE'] = 'The first step before anything, should be to register yourself.';
$lang['DASH_BEFORE_ADD'] = 'Hit the button "Add Record" to create a new record and fill it whit your informations.';
$lang['DASH_BEFORE_ADD'] = 'Hit the button "Add Record" to create a new record.';
$lang['DASH_BEFORE_SEARCH'] = 'The button "Search Record" is use to find a record, you can make a search with the full name of a citizen or with his CID.';
$lang['DASH_BEFORE_LOGOUT'] = 'The button "Log Out" let you log out from the dashboard, if you have checked the checkbox "Keep me logged in", it will no more be effective.';

// Add

$lang['ADD_FNAME'] = 'First name';
$lang['ADD_LNAME'] = 'Last name';
$lang['ADD_DESC_PH'] = 'Ex: Brown hair, Beard of three days, etc...';
$lang['ADD_OBSERV_PH'] = 'Comment...';
$lang['ADD_GENERATE'] = 'Generated record';
$lang['ADD_ERR_1_1'] = 'Record saved !';
$lang['ADD_ERR_1_2'] = 'Back to dashbord';
$lang['ADD_ERR_2'] = 'DATA Error: Erroneous Loyalty Points';
$lang['ADD_ERR_3'] = 'DATA Error: Identity already used. Contact the PC for relocation';
$lang['ADD_ERR_4'] = 'DATA Error: Corrupted CID';
$lang['ADD_ERR_5'] = 'DATA Error: Erroneous CID (Too Short)';
$lang['ADD_ERR_6'] = 'DATA Error: Erroneous CID or Loyalty Points ( not digital)';
$lang['ADD_ERR_7'] = 'DATA Error: Erroneous data ( Fist name and Last name: max. 255 chars | CID: max. 5 chars | Loyalty Point: max. 3 chars )';
$lang['ADD_ERR_8'] = 'DATA Error: Missing information';

// Fiche

$lang['FILE_TITLE'] = 'Record';
$lang['FILE_OF'] = 'Record of CID';
$lang['FILE_FULLNAME'] = 'Full name';
$lang['FILE_PLOYAUTE'] = 'Loyalty Points';
$lang['FILE_PANTI'] = 'Anti-Citizenship points';
$lang['FILE_STATUS'] = 'Status';
$lang['FILE_STATUS_1'] = 'Anti-Citizen';
$lang['FILE_STATUS_2'] = 'Citizen';
$lang['FILE_STATUS_3'] = 'Waitting for test';
$lang['FILE_STATUS_4'] = 'Loyalist';
$lang['FILE_STATUS_5'] = 'CWU R';
$lang['FILE_STATUS_6'] = 'CWU I';
$lang['FILE_STATUS_7'] = 'CWU C';
$lang['FILE_STATUS_8'] = 'Supervisor';
$lang['FILE_DESC'] = 'Physical Description';
$lang['FILE_OBSERV'] = 'Observation';
$lang['FILE_DELFILE'] = 'Delete record';
$lang['FILE_AST'] = '* Write '.htmlspecialchars("<br/>").' to make a line break';
$lang['FILE_ERR_1'] = 'DATA Error: Corrupted CID';
$lang['FILE_ERR_2'] = 'DATA Error: Erroneous CID';
$lang['FILE_ERR_3'] = 'DATA Error: Identity already used. Contact the PC for relocation';
$lang['FILE_ERR_4'] = 'DATA Error: Erroneous data (Muliple)';
$lang['FILE_ERR_5'] = 'DATA Error: Erroneous data';

// Search

$lang['SEARCH_BAR'] = 'Search...';
$lang['SEARCH_SEEFILE'] = 'See record';
$lang['SEARCH_ERR_1_1'] = 'Nothing found for CID #';
$lang['SEARCH_ERR_1_2'] = 'Add to Data Base';
$lang['SEARCH_ERR_2_1'] = 'DATA Error:';
$lang['SEARCH_ERR_2_2'] = 'citizens named';
$lang['SEARCH_ERR_2_3'] = ', contact the PC for relocation';
$lang['SEARCH_ERR_3'] = 'DATA Error: Nothing found for citizen';

// Admin

$lang['ADMIN_TITLE'] = 'Admin Dashbord';
$lang['ADMIN_SUPERVISOR'] = 'Your Authorized CWU';
$lang['ADMIN_BEFORE'] = 'The first step before anuthing, should be to register a CWU.';
$lang['ADMIN_BEFORE_ADD'] = 'Hit the "Add a CWU" button to add one and fill it with the nessesairies informations.';
$lang['ADMIN_BEFORE_SEARCH'] = 'The "Search a CWU" is used to modify or delete a CWU, you can serach by full name or pseudo.';
$lang['ADMIN_BEFORE_LOGOUT'] = 'The "Log out" button let you log out from the admin dashbord, remeber that even if you checked the "Keep me logged in" checkbox, because you are in the admin section it will not be effective.';
$lang['ADMIN_ADD'] = 'Add a CWU';
$lang['ADMIN_SEARCH'] = 'Search a CWU';
$lang['ADMIN_EXP'] = 'Expiration of your subsciption';

// Admin Add

$lang['ADD_ADMIN_PSEUDO'] = 'Pseudo';
$lang['ADD_ADMIN_MDP'] = 'Password';
$lang['ADD_ADMIN_GENERATE'] = 'CWU added';
$lang['ADD_ADMIN_ERR_1_1'] = 'CWU added !';
$lang['ADD_ADMIN_ERR_1_2'] = 'Back to dashbord';
$lang['ADD_ADMIN_ERR_2'] = 'DATA Error: Pseudo already used';
$lang['ADD_ADMIN_ERR_3'] = 'DATA Error: Full name already used';
$lang['ADD_ADMIN_ERR_4'] = 'DATA Error: Erroneous data (First name, Last name and Pseudo: max. 255 chars)';
$lang['ADD_ADMIN_ERR_5'] = 'DATA Error: Missing information';

// Search Admin

$lang['SEARCH_ADMIN_TITLE'] = 'Search a CWU';
$lang['SEARCH_ADMIN_ERR_1'] = 'DATA Error: Full name required (First name and last name) or Pseudo';
$lang['SEARCH_ADMIN_ERR_2'] = 'DATA Error: Nothing found for the Pseudo';
$lang['SEARCH_ADMIN_ERR_3'] = 'DATA Error: Nothing found for the CWU';
$lang['SEARCH_ADMIN_ERR_2_2'] = 'CWUs named';

// Dossier Admin

$lang['FILE_ADMIN_TITLE'] = 'CWU Records';
$lang['FILE_ADMIN_OF'] = 'CWU Records of';
$lang['FILE_ADMIN_MDP_2'] = 'The password is crypted';
$lang['FILE_ADMIN_DELMSG'] = 'Are you sure you want to delete this profil ?';
$lang['FILE_ADMIN_ERR_1'] = 'DATA Error: Pseudo already used';
$lang['FILE_ADMIN_ERR_2'] = 'DATA Error: Erroneous Pseudo';
$lang['FILE_ADMIN_ERR_3'] = 'DATA Error: Last name already used';

// Others

$lang['COPYRIGHT'] = 'GEPS Conception | All rights reserved';
$lang['RETURN'] = 'Return';
$lang['SAVE'] = 'Save';
$lang['CANCEL'] = 'Cancel';
$lang['DEL'] = 'Delete';
$lang['FILTER'] = 'Filter';
$lang['SEARCHED'] = 'Searched';
$lang['LOSTED'] = 'Lost';
$lang['DEAD'] = 'Deceaded';
$lang['ALLFILE'] = 'All (May lag';
$lang['MODIFY'] = 'Modify';
$lang['RECOMP'] = 'Reward';
$lang['REPRIM'] = 'Reprimand';
$lang['ADMIN_BUY'] = 'Buy access to the Data Base for my server';
$language = 'en';

?>
