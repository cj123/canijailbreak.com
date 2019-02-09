package main

import (
	"encoding/json"
	"fmt"
	"io/ioutil"
	"log"
	"net/http"
	"os"

	"github.com/cj123/canijailbreak.com/model"

	"gopkg.in/yaml.v2"
)

func validate(j *model.Jailbreaks) error {
	for _, jailbreak := range j.Jailbreaks {
		if jailbreak.URL == "" {
			continue
		}

		err := validateJailbreak(jailbreak)

		if err != nil {
			return err
		}
	}

	return nil
}

func validateJailbreak(jailbreak *model.Jailbreak) error {
	log.Printf("Testing url: %s for jailbreak %s\n", jailbreak.URL, jailbreak.Name)

	r, err := http.NewRequest(http.MethodGet, jailbreak.URL, nil)

	if err != nil {
		return err
	}

	r.Header.Add("User-Agent", "canijailbreak.com")

	res, err := http.DefaultClient.Do(r)

	if err != nil {
		return err
	}

	defer res.Body.Close()

	if res.StatusCode >= 400 {
		return fmt.Errorf("URL: %s for jailbreak %s (iOS %s) is not valid (status code: %d)", jailbreak.URL, jailbreak.Name, jailbreak.Firmwares.Start, res.StatusCode)
	}

	return nil
}

func marshalToFile(j *model.Jailbreaks, filename string) error {
	out, err := json.Marshal(j)

	if err != nil {
		return err
	}

	return ioutil.WriteFile(filename, out, 0644)
}

func getJailbreaks(filename string) (jb *model.Jailbreaks, err error) {
	jailbreakFile, err := os.Open(filename)

	if err := yaml.NewDecoder(jailbreakFile).Decode(&jb); err != nil {
		return nil, err
	}

	return jb, err
}
