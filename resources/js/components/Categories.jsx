import React, { useState, useEffect } from "react";
import axios from "axios";

const Categories = () => {
  const [categories, setCategories] = useState([]);

  useEffect(() => {
    axios
      .get("/api/categories")
      .then((response) => {
        setCategories(response.data);
      })
      .catch((error) => {
        console.error("There was an error fetching the categories!", error);
      });
  }, []);

  return (
    <div>
      {categories.length > 0 ? (
        categories.map((category) => (
          <div key={category.id} className="category-card">
            <h3>{category.nomcategorie}</h3>
            {category.imagecategorie && (
              <img
                src={category.imagecategorie}
                alt={category.nomcategorie}
                style={{ width: "100px", height: "100px" }}
              />
            )}
          </div>
        ))
      ) : (
        <p>No categories available</p>
      )}
    </div>
  );
};

export default Categories;
