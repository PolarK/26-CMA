<?php

    class Toast {

        public static function errorToast($text) {

            return "<script>
                        $.toast({                            
                            text: '". $text. "',
                            icon: 'info',
                            bgColor: '#EA0000',
                            loader: false,
                            hideAfter: 6000,
                            position: {
                                left: 10,
                                top: 110
                            },
                        });
                    </script>";             
        }

        public static function infoToast($text) {

            return "<script>
                        $.toast({                            
                            text: '". $text. "',
                            icon: 'info',
                            loader: false,
                            hideAfter: 6000,
                            position: {
                                left: 10,
                                top: 110
                            },
                        });
                    </script>";             
        }

        public static function successToast($text) {

            return "<script>
                        $.toast({                            
                            text: '". $text. "',
                            icon: 'success',
                            loader: false,
                            hideAfter: 6000,
                            position: {
                                left: 10,
                                top: 110
                            },
                        });
                    </script>";
        }

        public static function successSubmission($id) {

            return "<script>
                       party.confetti(document.getElementById('" . $id . "')); 
                    </script>";
        }
    
    }

?>