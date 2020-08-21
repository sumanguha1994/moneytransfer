using FIREBASE WITH CodeIgniter

package:: composer require kreait/firebase-php ^4.18
2.Edit file application/config/autoload.php replace this following line.
    $autoload['libraries'] = array('firebase');
    $autoload['config'] = array('firebase');
3.Goto Firebase Console navigate to Project settings -> Service accounts in the Firebase Admin SDK tab, click to the "Generate new private key" button then click "Generate key" to download .json file and save as to application/config folder in the project.
4.Copy your .json file name from step 3. replace it to application/config/firebase.php file in the $config['filebase_app_key] array like this.
    $config['firebase_app_key'] = __DIR__ . '/../config/your-app-firebase-adminsdk-xxxxx-xxxxxxxxxx.json';
5.Now. You can use firebase library in the Controller file like this.
    $this->load->library('firebase');
    $firebase = $this->firebase->init();
    $db = $firebase->getDatabase();

        ---------------  rest of the part are in FireCtrl.php  -----------------------