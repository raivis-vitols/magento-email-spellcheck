# Email SpellCheck Extension for Magento

[![Codacy Badge](https://api.codacy.com/project/badge/grade/2f4ac840363d45de8a1e53be45c8ba03)](https://www.codacy.com/app/raivis-vitols/magento-email-spellcheck)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/raivis-vitols/magento-email-spellcheck/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/raivis-vitols/magento-email-spellcheck/?branch=master)

Email SpellCheck extension for Magento helps your customers to spot and correct any misspelled email addresses in your web forms - be it checkout, registration, newsletter or any other form. Right after user finishes typing an email, extension checks it for typos and suggests to correct it if finds any.

If user enters "john@gnail.com" email address in any of your web forms with the Email SpellCheck enabled, extension will check the email entered and show "Did you mean john@gmail.com?" message next to the email field - user will be able to fix the typo by clicking the suggestion.

Reduce any chances of users registering, signing up for newsletter or checking out with incorrect email address. Extension can also be enabled for any web form in Magento administrator panel - therefore, it helps you avoid misspelled email addresses when entering customer, order or any other information. Built on top of - [https://github.com/mailcheck/mailcheck](https://github.com/mailcheck/mailcheck)

#### Frontend Features

- No more misspelled customer, newsletter subscriber or order detail email addresses;
- Target specific email address fields to check for typos or enable for all fields at once;
- Comes bundled with clean, lightweight and minimalistic look & feel for email suggestions.

#### Admin Features

- Easily edit suggestion text message, target email fields or disable extension if you need;
- Enable Email SpellCheck for administration panel email fields and avoid typos yourself!;
- Not checking typo in your specific domain? Simply add it to list of domain names to check.

#### General Features
- True plug & play solution - install it, configure and it's ready to use;
- No extension conflicts guaranteed - built without a single core class rewrite;
- Clean, lightweight and extendable solution - use it as it is or modify without a hassle.
- Well structured and commented code, not a bit of it is encrypted, follows best practices;

## Compatibility
Magento Community: 1.7.x - 1.9.x, Magento Enterprise: 1.12.x - 1.14.x

## Configuration
Navigate to "System -> Configuration", open "Email SpellCheck" tab under "Advanced" section, open "General" section and make sure field value for "Enabled" field is set to "Yes";

By default, all email fields will have email validation enabled. To adjust it, use "Front-End Email Field Selector" or "Admin Email Field Selector" config fields. Adjust the rest of available configurations to your needs - each field contains comment explaining the resulting behaviour. Email SpellCheck extension for Magento checks misspelled emails based on following domains:
```
msn.com, bellsouth.net, telus.net, comcast.net, optusnet.com.au, web.de, earthlink.net, qq.com, sky.com, icloud.com, mac.com, sympatico.ca, googlemail.com, att.net, xtra.co.nz, cox.net, gmail.com, ymail.com, aim.com, rogers.com, verizon.net, rocketmail.com, google.com, optonline.net, sbcglobal.net, aol.com, me.com, btinternet.com, charter.net, shaw.ca
```

Top level domains:
```
com, com.au, com.tw, ca, co.nz, co.uk, de, fr, it, ru, net, org, edu, gov, jp, nl, kr, se, eu, ie, co.il, us, at, be, dk, hk, es, gr, ch, no, cz, in, net, net.au, info, biz, mil, co.jp, sg, hu
```

Second level domains:
```
yahoo, hotmail, mail, live, outlook, gmx
```

In order to add more domain names to be checked for typos in forms with Email SpellCheck enabled, use the configuration under "System -> Configuration -> Advanced -> Email SpellCheck -> Advanced" and add new domain names in comma separated format.
