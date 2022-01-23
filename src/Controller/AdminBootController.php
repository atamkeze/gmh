<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Security\UserAuthenticator;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
#Files
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use PHPUnit\TextUI\XmlConfiguration\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class AdminBootController extends AbstractController
{
        /**
     * @Route("update-admin/{id}", name="app_update_admin_profile")
     */
    public function update_admin_profile(Request $request, SluggerInterface $slugger, $id)
    {
        $datas = $request -> request -> all();


        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findBy(['id' => $id]);

        $em = $this->getDoctrine()->getManager();

    // Profile Photos management
    
    // FileName is called from the form via the POST METHOD
    $profile_photo = $request->files->get('profile_photo');
    if ($profile_photo && $profile_photo != null ) {
        // Set the directory or folder by which the images will be uploaded to in SERVICES.YAML
            $uploads_directory = $this->getParameter('uploads_directory');
            $filename = md5(uniqid()) . '.' . $profile_photo->guessExtension();
            $profile_photo->move(
                $uploads_directory,
                $filename
            );
            foreach($users as $user){
                $user->setProfilePhoto($filename);
            }
        
        }
        foreach($users as $user){
            $user->setName($datas['name']);
            $user->setUsername($datas['username']);
            // $user->setDateOfBirth(new \DateTime());
            $user->setLocation($datas['address']);
            $user->setEmail($datas['email']);
            $user->setGender($datas['gender']);
            $user->setDob(new \DateTime());
            $user->setBio($datas['bio']);
            // $user->setCoverPhoto($datas['cover_photo']);
              
            $em->flush();

            return $this->redirectToRoute('admin_profile');



        }

    }

}

            //     ##########################Uploading To Application Folder####################
       
            //     $filesystem = $request->files->get('new_file');
            //     if ($filesystem && $filesystem != null) {
            //        $extention = $filesystem->guessExtension();
            //        // Can add queries here to decide the filetypes to upload
            //        $nameErrorFile = $slugger->slug(pathinfo($filesystem->getClientOriginalName(), PATHINFO_FILENAME));
            //        $originalFilename = pathinfo($filesystem->getClientOriginalName(), PATHINFO_FILENAME);
            //        //This is needed to safely include the file name as part of the URL
            //        $safeFilename =  $slugger->slug($originalFilename);
            //        $newFilename = $safeFilename . '.' .$filesystem->guessExtension();
       
            //        try {
            //            $filesystem->move(
            //                $this->getParameter('file'),
            //                $newFilename
            //            );
            //        } catch (FileException $e) {
            //            //... handle exception if something happens during file upload
            //            //throw new Exception("Error Processing Request", 1);
            //        }
            //        //mettons la photo de profil de l'utilisateur a jour
            //        $repository = $this->getDoctrine()->getRepository(User::class);
            //        $users = $repository->findBy(['id' => $request->get('user_id')]);
       
            //        foreach($users as $user){
            //            $entityManager = $this->getDoctrine()->getManager();
            //            $user->setFile($newFilename);
            //            $entityManager->flush();
            //        }
       
            //    }
            //    ##########################Uploading To Database#################### 
            //    $file = new Files();
            //    $file->setFilename($newFilename);
            //    $entityManager = $this->getDoctrine()->getManager();
            //    $entityManager->persist($file);
            //    $entityManager->flush();