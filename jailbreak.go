package main

import (
	"encoding/json"
	"fmt"
	"io/ioutil"
	"log"
	"net/http"
	"os"

	"github.com/cj123/canijailbreak.com/model"
)

func validate(j *model.JailbreakJSON) error {
	for _, jailbreak := range j.Jailbreaks {
		if jailbreak.URL == "" {
			continue
		}

		log.Printf("Testing url: %s for jailbreak %s\n", jailbreak.URL, jailbreak.Name)

		res, err := http.Get(jailbreak.URL)

		if err != nil {
			return err
		}

		if res.StatusCode >= 400 {
			return fmt.Errorf("URL: %s for jailbreak %s (iOS %s) is not valid (status code: %d)", jailbreak.URL, jailbreak.Name, jailbreak.Firmwares.Start, res.StatusCode)
		}

		res.Body.Close()
	}

	return nil
}

func marshalToFile(j *model.JailbreakJSON, filename string) error {
	out, err := json.Marshal(j)

	if err != nil {
		return err
	}

	return ioutil.WriteFile(filename, out, 0644)
}

func getJailbreaks(filename string) (jb *model.JailbreakJSON, err error) {
	jailbreakFile, err := os.Open(filename)

	d := json.NewDecoder(jailbreakFile)

	jb = &model.JailbreakJSON{}
	err = d.Decode(&jb)

	if err != nil {
		return nil, err
	}

	return jb, err
}
