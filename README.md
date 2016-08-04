canijailbreak.com
=================

a replacement (for the replacement) jailbreaking site for the (seemingly out of date) [jailbrea.kr](http://jailbrea.kr).

## Contributing

We welcome contributions to the code/design/data of the site! Currently, it's fairly basic.

A few guidelines for contributing:

1. **No beta jailbreaks**
2. **No beta iOS versions**
3. **Use one pull request per jailbreak addition** - this will allow us to easily approve/reject new additions on a one-by-one basis.
4. Commit tags for new jailbreaks, in the form of `[jailbreak] <name> <version> for <ios versions>` are recommended :)
5. Try to find the _simplest_ route to jailbreak, such as one click GUIs, that support _as many devices/ios versions as possible_.


## installation

```bash

$ go get github.com/cj123/canijailbreak.com
$ cd $GOPATH/src/github.com/cj123/canijailbreak.com
$ go build .
```

## running it

```bash
$ ./canijailbreak.com --help
```

This will generate output, by default into `./static`. 

## adding jailbreaks

look in the file `./jailbreaks.json` for a layout

then run the `./canijailbreak.com` util again
