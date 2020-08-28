# composer plugin

This is the output with a fresh installation of version 1.0.3 with a composer.lock file 

```
postInstall is triggered
Plugin version constant: 1.0.3
Plugin version file: 1.0.3
Plugin version: 1.0.3
```


This is the output with version 1.0.2 installed upgraded to version 1.0.3 

```
postUpdate is triggered
Plugin version constant: 1.0.2
Plugin version file: 1.0.3
Plugin version: 1.0.3
```

## conclusion

- if the plugin is installed the old code is used
- reading version from non php/code files work
- detecting the installed version via composer works as well
- detecting the installed version in composer 2 is even much simpler
