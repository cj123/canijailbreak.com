package main

import (
	"bytes"
	"flag"
	"io/ioutil"
	"log"
	"os"
	"path"
)

var (
	inFile     string
	outDir     string
	skipChecks bool
)

func init() {
	flag.StringVar(&inFile, "i", "./jailbreaks.yml", "the jailbreaks data file")
	flag.StringVar(&outDir, "o", "./static", "the output directory. is created if it doesn't exist")
	flag.BoolVar(&skipChecks, "s", false, "skip URL checks")
	flag.Parse()
}

func main() {
	jbs, err := getJailbreaks(inFile)

	if err != nil {
		log.Fatalln("Unable to open jailbreaks file at: " + inFile)
	}

	if !skipChecks {
		err = validate(jbs)

		if err != nil {
			log.Printf("Jailbreak URL validation failed, err: %s", err)
		}
	}

	err = os.MkdirAll(outDir, 0755)

	if err != nil {
		log.Fatalln("Unable to create output directory at: " + outDir)
	}

	pages := [...]page{
		{
			base:     "base",
			template: "index",
			data: map[string]interface{}{
				"MostRecent": jbs.Jailbreaks[0],
				"Jailbreaks": jbs.Jailbreaks[1:],
			},
		},
		{
			base:     "base",
			template: "help",
			data:     nil,
		},
	}

	for _, page := range pages {
		buf := new(bytes.Buffer)

		err := renderTemplate(
			buf,
			page.toHTML(page.template),
			page.toHTML(page.base),
			page.data,
		)

		if err != nil {
			log.Fatalln("Error rendering `" + page.template + "` template: " + err.Error())
		}

		outFile := path.Join(outDir, page.toHTML(page.template))

		err = ioutil.WriteFile(outFile, buf.Bytes(), 0644)

		if err != nil {
			log.Fatalln("Error outputting file `" + outFile + "`: " + err.Error())
		}
	}

	// marshal the json and output that to the static folder too, for the "api"
	marshalToFile(jbs, path.Join(outDir, "jailbreaks.json"))
}
