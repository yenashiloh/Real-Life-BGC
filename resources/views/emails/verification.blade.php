
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Email Confirmation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
  /**
   * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
    <!--[if mso]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <![endif]-->
  	<title>Verify Email Address</title>
		<style type="text/css">
      /* === Custom Fonts === */
      /* Add your fonts here via imports */
      @media screen {
    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 400;
      src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
    }
    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 700;
      src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
    }
  }
  /**
   * Avoid browser level font resizing.
   * 1. Windows Mobile
   * 2. iOS / OSX
   */
  body,
  table,
  td,
  a {
    -ms-text-size-adjust: 100%; /* 1 */
    -webkit-text-size-adjust: 100%; /* 2 */
  }
  /**
   * Remove extra space added to tables and cells in Outlook.
   */
  table,
  td {
    mso-table-rspace: 0pt;
    mso-table-lspace: 0pt;
  }
  /**
   * Better fluid images in Internet Explorer.
   */
  img {
    -ms-interpolation-mode: bicubic;
  }
  /**
   * Remove blue links for iOS devices.
   */
  a[x-apple-data-detectors] {
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    color: inherit !important;
    text-decoration: none !important;
  }
  /**
   * Fix centering issues in Android 4.4.
   */
  div[style*="margin: 16px 0;"] {
    margin: 0 !important;
  }
  body {
    width: 100% !important;
    height: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  /**
   * Collapse table borders to avoid space between cells.
   */
  table {
    border-collapse: collapse !important;
  }
  a {
    color: #1a82e2;
  }
  img {
    height: auto;
    line-height: 100%;
    text-decoration: none;
    border: 0;
    outline: none;
  }
      /* === Client Styles === */
      #outlook a {padding: 0;}
      .ReadMsgBody {width: 100%;} .ExternalClass {width: 100%;}
      .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}        
      body, table, td, p, a, li, blockquote {-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;}
      table, td {mso-table-lspace: 0pt; mso-table-rspace: 0pt;}
      img {-ms-interpolation-mode: bicubic;}

      /* === Reset Styles === */
      body, p, h1, h3 {margin: 0; padding: 0;}
      img {border: 0; display: block; height: auto; line-height: 100%; max-width: 100%; outline: none; text-decoration: none;}
      table, td {border-collapse: collapse}
      body {height: 100% !important; margin: 0; padding: 0; width: 100% !important;}

      /* === Page Structure === */
      /*
      Set the background color of your email. Light neutrals or your primary brand color are most common.
      */
      body {
        background-color: #f8fafc; /* Edit */
      }

      /*
      This optional section will be hidden in your email but the text will appear after the subject line. 
      */
      #preheader {display: none !important; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; mso-hide: all !important; opacity: 0; overflow: hidden; visibility: hidden;}

      /*
      Set the background color, border and radius of your primary content area. White or light neutrals for the background-color are recommended.
      */
      .panel-container {
        background-color: #ffffff; /* Edit */
        border: 1px solid #eaebec; /* Edit */
        border-collapse: separate;
        border-radius: 2px; /* Edit */
      }

      /*
      Set the horizontal padding of your content areas. Any changes should following the default spacing scale.
      */         
      #header, #footer {padding-left: 32px; padding-right: 32px;}
      .panel-body {padding-left: 32px; padding-right: 32px;}

      /*
      Set the sizes of your spacer rows. Spacers are used for vertical padding. Any changes should following the default spacing scale.
      */
      .spacer-xxs, .spacer-xs, .spacer-sm, .spacer-md, .spacer-lg, .spacer-xl, .spacer-xxl {display: block; width: 100%;}
      .spacer-xxs {height: 4px; line-height: 4px;}
      .spacer-xs {height: 8px; line-height: 8px;}
      .spacer-sm {height: 16px; line-height: 16px;}
      .spacer-md {height: 24px; line-height: 24px;}
      .spacer-lg {height: 32px; line-height: 32px;}
      .spacer-xl {height: 40px; line-height: 40px;}
      .spacer-xxl {height: 48px; line-height: 48px;}
      
      /* === Page Styles === */
      /*
      Set the font-family of your type. Classes should be set directly on the table cell for compatibility with older clients. Any changes should following the default typography scale.
      */
      .headline-one, .headline-two, .headline-three, .heading, .subheading, .body, .caption, .button, .table-heading {
        font-family: -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif; /* Edit */
        font-style: normal;
        font-variant: normal;
      }
      .headline-one {font-size: 32px; font-weight: 500; line-height: 40px;}
      .headline-two {font-size: 24px; font-weight: 500; line-height: 32px;}
      .headline-three {font-size: 20px; font-weight: 500; line-height: 24px;}
      .heading {font-size: 16px; font-weight: 500; line-height: 24px;}
      .subheading {font-size: 12px; font-weight: 700; line-height: 16px; text-transform: uppercase;}
      .body {font-size: 14px; font-weight: 400; line-height: 20px;}
      .caption {font-size: 12px; font-weight: 400; line-height: 16px;}
      .table-heading {font-size: 10px; font-weight: 700; text-transform: uppercase;}

      /*
      Set the styles of your links.
      */
      a {color: inherit; font-weight: normal; text-decoration: underline;}

      /*
      Set the colors of your text.
      */      
      .text-primary {
        color: #007bff; /* Edit */
      }
      .text-secondary {
        color: #6c757d; /* Edit */
      }
      .text-black {
        color: #000000; /* Edit */
      }
      .text-dark-gray {
        color: #343a40; /* Edit */
      }
      .text-gray {
        color: #6c757d; /* Edit */
      }
      .text-light-gray {
        color: #f8f9fa; /* Edit */
      }
      .text-white {
        color: #ffffff; /* Edit */
      }
      .text-success {
        color: #28a745; /* Edit */
      }
      .text-danger {
        color: #dc3545; /* Edit */
      }
      .text-warning {
        color: #ffc107; /* Edit */
      }
      .text-info {
        color: #17a2b8; /* Edit */
      }

      /*
      Set the styles of your buttons. Each button requires a matching background.
      */
      .button-bg {
        border-radius: 2px; /* Editable */
      }
      
      .button {
        border-radius: 2px; /* Editable */
        color: #ffffff; /* Editable */
        display: inline-block;
        font-size: 14px;
        font-weight: 700;       
        padding: 10px 20px 10px;
        text-decoration: none;
        background-color: #71BF44;
      }
     

      /*
      Set the styles of your tabular information. This class should not be set on tables with a role of presentation.
      */
      .table {min-width: 100%; width: 100%;}
      .table td {
        border-top: 1px solid #eaebec; /* Editable */
        padding-bottom: 12px;
        padding-left: 12px;
        padding-right: 12px;
        padding-top: 12px;
        vertical-align: top;
      }
      
      /*
      Set the styles of your utility classes.
      */
      .address, .address a {color: inherit !important;}
      .border-solid {
        border-style: solid !important;
        border-width: 2px !important; /* Edit */
        border-color: #eaebec !important; /* Edit */
      }
      .divider {
        border-bottom: 0px; 
        border-top: 1px solid #eaebec; /* Edit */
        height: 1px; 
        line-height: 1px;
        width: 100%;
      }    
      .text-bold {font-weight: 700;}
      .text-italic {font-style: italic;}
      .text-uppercase {text-transform: uppercase;}
      .text-underline {text-decoration: underline;}

      @media only screen and (max-width: 599px) 
      {
        /* === Client Styles === */        
        body, table, td, p, a, li, blockquote {-webkit-text-size-adjust: none !important;}
        body {min-width: 100% !important; width: 100% !important;}
        center {padding-left: 12px !important; padding-right: 12px !important;}

        /* === Page Structure === */
        /*
        Adjust sizes and spacing on mobile.
        */
        #email-container {max-width: 600px !important; width: 100% !important;}
        #header, #footer {padding-left: 24px !important; padding-right: 24px !important;}
        .panel-container {max-width: 600px !important; width: 100% !important;}  
        .panel-body {padding-left: 24px !important; padding-right: 24px !important;}
        .column-responsive {display: block !important; padding-bottom: 24px !important; width:100% !important;}
        .column-responsive img {width: auto !important;}
        .column-responsive-last {padding-bottom: 0px !important;}
        .column-responsive-gutter {display: none !important;}

        /* === Page Styles === */
        /*
        Adjust sizes and spacing on mobile.
        */
      }    
    </style>    
    <!--[if gte mso 9]>
    <xml>
      <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <!--[if mso]>
      <xml xmlns:w="urn:schemas-microsoft-com:office:word">
        <w:WordDocument><w:AutoHyphenation/></w:WordDocument>
      </xml>
    <![endif]-->
	</head>
<body>
  <center>
  <!-- Start Email Container -->
  <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="600" id="email-container">
    <tbody>
      <!-- Start Preheader -->
      <!-- End Preheader -->
      <tr>
        <td class="spacer-lg"></td>
      </tr>
      <tr>
        <td valign="top" id="email-body">
          <!-- Start Panel Container -->
          <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" class="panel-container">
            <tbody>
              <tr>
                <td class="spacer-lg"></td>
              </tr>
              <!-- Start Header -->
              {{-- <tr>
                <td align="left" id="header">
                  <a href="https://www.example.com">
                    <img alt="Company" border="0" src="https://www.vouchful.com/images/email-kit/placeholder-logo.png" width="56">
                  </a>
                </td>
              </tr> --}}
              <!-- End Header -->
              <tr>
                <td class="spacer-lg"></td>
              </tr>
              <tr>
                <td class="panel-body">
                  <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                    <tbody>
                      <!-- Start Text -->                                
                      <tr>
                        <td align="left" class="headline-two text-dark-gray">
                          Verify your email address
                          
                        </td>
                      </tr>
                      <!-- End Text -->
                      <tr>
                        <td class="spacer-sm"></td>
                      </tr>                                 
                      <!-- Start Text -->                                
                      <tr>
                        <td align="left" class="text-dark-gray">
                         For your application to be processed, please click the verify email address button
                        </td>
                      </tr>
                      <!-- End Text -->
                      <tr>
                        <td class="spacer-md"></td>
                      </tr>
                      <!-- Start Button -->
                      <tr>          
                        <td align="left">
                          <table border="0" cellspacing="0" cellpadding="0" role="presentation">
                            <tbody>
                              <tr>
                                <td align="left" class="button-bg button-bg-primary">
                                  <a href="{{ route('verify', ['token' => $applicant->api_token]) }}" class="button" style="background-color: #71BF44; color: white;">Verify Email Address</a>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                      <!-- End Button -->
                      <tr>
                        <td class="spacer-md"></td>
                      </tr>                                 
                      <!-- Start Text -->                               
                     
                      </tr>
                      <!-- End Text -->
                      <tr>
                        <td class="spacer-lg"></td>
                      </tr>
                      <!-- Start Text -->                                
                      
                      <!-- End Text -->
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td class="spacer-lg"></td>
              </tr>
            </tbody>
          </table>
          <!-- End Panel Container  -->
        </td>
      </tr>
      <tr>
        <td class="spacer-lg"></td>
      </tr>
      <!-- Start Footer -->
      <tr>
        <td align="left" id="footer">
          <table border="0" cellpadding="0" cellspacing="0" role="presentation">
            <tbody> 
              <tr>
                <td align="left">
                  <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                    <tbody>
                      
                    </tbody>
                  </table>  
                </td>
              </tr>        
              <tr>
                <td class="spacer-sm"></td>
              </tr>             
              <tr>
                <td align="left" class="text-secondary">
                  &#169; Real LIFE Foundation All Rights Reserved.
                  <br />
                  <span class="address">32nd Street corner
                    Bonifacio Global City,
                    1634 Philippines
                    </span>
                </td>
              </tr>
              <tr>
                <td class="spacer-md"></td>
              </tr>       
              <tr>
                {{-- <td align="left" class="text-secondary">
                  You are being contacted because you signed up for Company.
                  <br />
                  <a href="https://www.example.com" class="text-primary">Unsubscribe</a> | <a href="https://www.example.com" class="body text-primary">Privacy Policy</a> | <a href="https://www.example.com" class="body text-primary">Support</a>
                </td> --}}
              </tr>    
            </tbody>           
          </table>
        </td>
      </tr> 
      <!-- End Footer -->
      <tr>
        <td class="spacer-lg"></td>
      </tr>     
    </tbody>
  </table>
  <!-- End Email Container -->
  </center>
</body>
</html>