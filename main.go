package main

import (
	"bytes"
	"flag"
	"fmt"
	"io/ioutil"
	"os"
	"path"
)

var (
	inFile string
	outDir string
)

func init() {
	flag.StringVar(&inFile, "i", "./jailbreaks.json", "the jailbreaks data file")
	flag.StringVar(&outDir, "o", "./static", "the output directory. is created if it doesn't exist")

	flag.Parse()
}

func main() {
	jbs, err := getJailbreaks(inFile)

	if err != nil {
		fmt.Println("Unable to open jailbreaks file at: " + inFile)
		os.Exit(1)
	}

	err = os.MkdirAll(outDir, 0755)

	if err != nil {
		fmt.Println("Unable to create output directory at: " + outDir)
		os.Exit(1)
	}

	pages := [...]page{
		page{
			base:     "base",
			template: "index",
			data: map[string]interface{}{
				"MostRecent": jbs.Jailbreaks[0],
				"Jailbreaks": jbs.Jailbreaks[1:],
			},
		},
		page{
			base:     "base",
			template: "help",
			data:     nil,
		},
	}

	for _, page := range pages {
		buf := new(bytes.Buffer)

		err := renderTemplate(
			buf,
			page.toTmpl(page.template),
			page.toTmpl(page.base),
			page.data,
		)

		if err != nil {
			fmt.Println("Error rendering `" + page.template + "` template: " + err.Error())
			os.Exit(1)
		}

		outFile := path.Join(outDir, page.toHTML(page.template))

		err = ioutil.WriteFile(outFile, buf.Bytes(), 0644)

		if err != nil {
			fmt.Println("Error outputting file `" + outFile + "`: " + err.Error())
			os.Exit(1)
		}
	}

	// marshal the json and output that to the static folder too, for the "api"
	jbs.marshalToFile(path.Join(outDir, "jailbreaks.json"))
}
